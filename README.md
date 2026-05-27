# PHPNomad Chrono

Time-related strategy interfaces for PHPNomad. Your code depends on a small set of strategies; the concrete implementations are swappable without touching consumers.

This package ships **interfaces only**. Pair it with an implementation package — for example [`phpnomad/wordpress-integration`](https://github.com/phpnomad/wordpress-integration), which binds WordPress's `current_datetime()` to `ClockStrategy`, or any PSR-20-compatible clock such as [`lcobucci/clock`](https://github.com/lcobucci/clock) or [`symfony/clock`](https://github.com/symfony/clock).

## Requirements

PHP 8.2 or newer.

## Installation

```bash
composer require phpnomad/chrono
```

You will also need a concrete `ClockStrategy` binding. On WordPress, install [`phpnomad/wordpress-integration`](https://github.com/phpnomad/wordpress-integration) and the binding is registered automatically. Elsewhere, bind any [PSR-20](https://www.php-fig.org/psr/psr-20/) `ClockInterface` implementation to `ClockStrategy` in your composition root.

## Usage

Inject `ClockStrategy` wherever you previously called `new DateTime()` or `time()` to read "now":

```php
use DateTimeImmutable;
use PHPNomad\Chrono\Interfaces\ClockStrategy;

final class TokenService
{
    public function __construct(private ClockStrategy $clock) {}

    public function isExpired(DateTimeImmutable $expiresAt): bool
    {
        return $expiresAt < $this->clock->now();
    }

    public function issueExpiringIn(string $relative): DateTimeImmutable
    {
        return $this->clock->now()->modify($relative);
    }
}
```

In tests, bind a frozen clock so time-dependent assertions are deterministic:

```php
$clock = new Lcobucci\Clock\FrozenClock(new DateTimeImmutable('2026-05-27T12:00:00Z'));
$service = new TokenService($clock);

$this->assertFalse($service->isExpired(new DateTimeImmutable('2026-05-27T13:00:00Z')));
$this->assertTrue($service->isExpired(new DateTimeImmutable('2026-05-27T11:00:00Z')));
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

## Why an abstraction

Anywhere your code reads "now" — token expiration, audit timestamps, scheduling windows, retry delays — is a place where a direct call to `new DateTime()` or `time()` makes the surrounding behavior untestable. Tests cannot assert "this token is valid at T but expired at T+1" without process-level clock mocking, which most PHP setups do not have.

`ClockStrategy` is the seam. Bind a real clock in production, bind a fixed clock in tests, swap to a WordPress-timezone-aware clock when running inside WordPress. The consumer code does not change.

## License

[MIT](LICENSE.txt)
