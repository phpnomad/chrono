# PHPNomad Chrono

Time-related contract interfaces for PHPNomad. Your code depends on a small set of interfaces; the concrete clock implementation is swappable without touching consumers.

This package ships **interfaces only**. Pair it with an implementation package — for example [`phpnomad/wordpress-integration`](https://github.com/phpnomad/wordpress-integration), which binds `current_datetime()` to `ClockStrategy`, or any PSR-20-compatible clock such as [`lcobucci/clock`](https://github.com/lcobucci/clock) or [`symfony/clock`](https://github.com/symfony/clock).

## Requirements

PHP 8.2 or newer.

## Installation

```bash
composer require phpnomad/chrono
```

You will also need a concrete `ClockStrategy` binding. On WordPress, install [`phpnomad/wordpress-integration`](https://github.com/phpnomad/wordpress-integration) and the binding is registered automatically. Elsewhere, bind any [PSR-20](https://www.php-fig.org/psr/psr-20/) `ClockInterface` implementation to `ClockStrategy` in your composition root.

## Usage

Inject `ClockStrategy` instead of constructing `DateTime` objects directly. Models that can expire implement `HasExpiration` and exercise the comparison against the injected clock.

```php
use DateTimeImmutable;
use PHPNomad\Chrono\Interfaces\ClockStrategy;
use PHPNomad\Chrono\Interfaces\HasCreatedDate;
use PHPNomad\Chrono\Interfaces\HasExpiration;

final class ApiKey implements HasExpiration, HasCreatedDate
{
    public function __construct(
        private DateTimeImmutable $expiresAt,
        private DateTimeImmutable $createdDate,
    ) {}

    public function getExpiresAt(): DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function getCreatedDate(): DateTimeImmutable
    {
        return $this->createdDate;
    }

    public function isExpired(ClockStrategy $clock): bool
    {
        return $this->expiresAt < $clock->now();
    }
}
```

Tests bind a frozen clock so expiration boundaries are deterministic:

```php
$clock = new Lcobucci\Clock\FrozenClock(new DateTimeImmutable('2026-05-27T12:00:00Z'));
$key   = new ApiKey(new DateTimeImmutable('2026-05-27T13:00:00Z'), $clock->now());

$this->assertFalse($key->isExpired($clock));
```

## Contract

### `ClockStrategy`

Extends PSR-20 `Psr\Clock\ClockInterface`. The PHPNomad-shaped alias exists so dependency-injection bindings follow the framework's strategy naming convention, but any PSR-20 implementation is structurally a valid binding without an adapter.

```php
interface ClockStrategy extends \Psr\Clock\ClockInterface
{
    // public function now(): \DateTimeImmutable;
}
```

### `HasExpiration`

Capability for any model that can expire at a defined point in time. Implementers expose the expiration instant and a clock-aware check.

```php
interface HasExpiration
{
    public function getExpiresAt(): \DateTimeImmutable;

    public function isExpired(ClockStrategy $clock): bool;
}
```

### `HasCreatedDate`, `HasModifiedDate`

Capabilities for models that record when they were created or last modified. Implementers receive these from an injected `ClockStrategy` rather than constructing `DateTime` objects directly.

```php
interface HasCreatedDate
{
    public function getCreatedDate(): \DateTimeImmutable;
}

interface HasModifiedDate
{
    public function getModifiedDate(): \DateTimeImmutable;
}
```

## Why an abstraction

Anywhere your code reads "now" — token expiration, audit timestamps, scheduling windows, retry delays — is a place where a direct call to `new DateTime()` or `time()` makes the surrounding behavior untestable. Tests cannot assert "this token is valid at T but expired at T+1" without process-level clock mocking, which most PHP setups do not have.

`ClockStrategy` is the seam. Bind a real clock in production, bind a fixed clock in tests, swap to a WordPress-timezone-aware clock when running inside WordPress. The consumer code does not change. The capability interfaces standardize the most common time-bound contracts so models across the framework expose the same shape.

## License

[MIT](LICENSE.txt)
