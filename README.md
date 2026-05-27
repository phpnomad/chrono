# PHPNomad Chrono

Time-related strategy interfaces for PHPNomad. A catalog of narrow capabilities that integration packages implement against any underlying time library — PSR-20, Carbon, Tokei, lcobucci/clock, symfony/clock, WordPress core, native PHP — so consumers can compose time-handling capabilities across libraries without touching call sites.

This package ships **interfaces only**. Pair it with one or more integration packages — for example [`phpnomad/wordpress-integration`](https://github.com/phpnomad/wordpress-integration), which binds WordPress's `current_datetime()`, `wp_timezone()`, `wp_date()`, and `human_time_diff()` to the appropriate interfaces.

## Requirements

PHP 8.2 or newer.

## Installation

```bash
composer require phpnomad/chrono
```

You will also need at least one concrete `ClockStrategy` binding. On WordPress, install [`phpnomad/wordpress-integration`](https://github.com/phpnomad/wordpress-integration) and the wiring is automatic. Elsewhere, bind any [PSR-20](https://www.php-fig.org/psr/psr-20/) `ClockInterface` implementation (e.g. [`lcobucci/clock`](https://github.com/lcobucci/clock) or [`symfony/clock`](https://github.com/symfony/clock)) to `ClockStrategy` in your composition root.

## Usage

Inject the capabilities you need. A consumer that does not care about formatting or arithmetic depends on `ClockStrategy` alone:

```php
use DateTimeImmutable;
use PHPNomad\Chrono\Interfaces\CanCheckIfPast;
use PHPNomad\Chrono\Interfaces\ClockStrategy;

final class TokenService
{
    public function __construct(
        private ClockStrategy $clock,
        private CanCheckIfPast $past,
    ) {}

    public function isExpired(DateTimeImmutable $expiresAt): bool
    {
        return $this->past->isPast($expiresAt);
    }

    public function issueExpiringIn(string $relative): DateTimeImmutable
    {
        return $this->clock->now()->modify($relative);
    }
}
```

In tests, bind a frozen `ClockStrategy` and a stub `CanCheckIfPast`:

```php
$clock = new Lcobucci\Clock\FrozenClock(new DateTimeImmutable('2026-05-27T12:00:00Z'));
$past  = new class ($clock) implements CanCheckIfPast {
    public function __construct(private ClockStrategy $clock) {}
    public function isPast(DateTimeImmutable $i): bool { return $i < $this->clock->now(); }
};
$service = new TokenService($clock, $past);

$this->assertFalse($service->isExpired(new DateTimeImmutable('2026-05-27T13:00:00Z')));
$this->assertTrue($service->isExpired(new DateTimeImmutable('2026-05-27T11:00:00Z')));
```

## Catalog

Each interface is narrow — one or a few related methods — so integrators can implement whatever subset their underlying library naturally covers. A single concrete class can implement many interfaces.

### Clock and provider state

| Interface | Method | Notes |
|---|---|---|
| `ClockStrategy` | `now(): DateTimeImmutable` | Extends `Psr\Clock\ClockInterface` |
| `HasTimezone` | `getTimezone(): DateTimeZone` | Platform's configured timezone |

### Predicates on a single instant

| Interface | Method |
|---|---|
| `CanCheckIfPast` | `isPast(DateTimeImmutable $instant): bool` |
| `CanCheckIfFuture` | `isFuture(DateTimeImmutable $instant): bool` |
| `CanCheckIfWeekend` | `isWeekend(DateTimeImmutable $instant): bool` |
| `CanCheckIfWeekday` | `isWeekday(DateTimeImmutable $instant): bool` |

### Predicates on two instants

| Interface | Method |
|---|---|
| `CanCheckSameDay` | `isSameDay(DateTimeImmutable $a, DateTimeImmutable $b): bool` |
| `CanCheckSameMonth` | `isSameMonth(DateTimeImmutable $a, DateTimeImmutable $b): bool` |
| `CanCheckSameYear` | `isSameYear(DateTimeImmutable $a, DateTimeImmutable $b): bool` |
| `CanCheckBetween` | `isBetween(DateTimeImmutable $i, DateTimeImmutable $start, DateTimeImmutable $end): bool` |

### Arithmetic

| Interface | Method |
|---|---|
| `CanApplyModifier` | `apply(DateTimeImmutable $instant, string $modifier): DateTimeImmutable` |
| `CanAddInterval` | `add(DateTimeImmutable $instant, DateInterval $interval): DateTimeImmutable` |
| `CanSubtractInterval` | `subtract(DateTimeImmutable $instant, DateInterval $interval): DateTimeImmutable` |

### Calendar boundaries

| Interface | Method |
|---|---|
| `CanGetStartOfDay` | `startOfDay(DateTimeImmutable $instant): DateTimeImmutable` |
| `CanGetEndOfDay` | `endOfDay(DateTimeImmutable $instant): DateTimeImmutable` |
| `CanGetStartOfMonth` | `startOfMonth(DateTimeImmutable $instant): DateTimeImmutable` |
| `CanGetEndOfMonth` | `endOfMonth(DateTimeImmutable $instant): DateTimeImmutable` |
| `CanGetStartOfYear` | `startOfYear(DateTimeImmutable $instant): DateTimeImmutable` |
| `CanGetEndOfYear` | `endOfYear(DateTimeImmutable $instant): DateTimeImmutable` |

### Difference and duration

| Interface | Method |
|---|---|
| `CanGetDifference` | `diff(DateTimeImmutable $a, DateTimeImmutable $b): DateInterval` |
| `CanGetDifferenceInDays` | `diffInDays(DateTimeImmutable $a, DateTimeImmutable $b): int` |
| `CanGetDifferenceInHours` | `diffInHours(DateTimeImmutable $a, DateTimeImmutable $b): int` |
| `CanGetDifferenceInMinutes` | `diffInMinutes(DateTimeImmutable $a, DateTimeImmutable $b): int` |
| `CanGetDifferenceInSeconds` | `diffInSeconds(DateTimeImmutable $a, DateTimeImmutable $b): int` |

### Parsing

| Interface | Method |
|---|---|
| `CanParseDate` | `parse(string $expression): DateTimeImmutable` |
| `CanParseDateWithFormat` | `parseFormat(string $expression, string $format): DateTimeImmutable` |

### Formatting

| Interface | Method |
|---|---|
| `CanFormatDate` | `format(DateTimeImmutable $instant, string $format): string` |
| `CanFormatLocalizedDate` | `formatLocalized(DateTimeImmutable $instant, string $format): string` |
| `CanFormatRelativeTime` | `relative(DateTimeImmutable $instant): string` ("3 hours ago") |

### Model contracts

These two are model-side contracts for persisted records — every PHPNomad model that participates in audit trails implements them.

| Interface | Method |
|---|---|
| `HasCreatedDate` | `getCreatedDate(): DateTimeImmutable` |
| `HasModifiedDate` | `getModifiedDate(): DateTimeImmutable` |

## How integrations compose the catalog

An integration package ships one or more concrete classes that implement the cluster of interfaces its underlying library can naturally fulfill. `phpnomad/wordpress-integration` ships a class implementing the WordPress-specific subset:

```php
class WordPressClockStrategy implements
    ClockStrategy,
    HasTimezone,
    CanFormatLocalizedDate,
    CanFormatRelativeTime
{
    public function now(): DateTimeImmutable { /* current_datetime() */ }
    public function getTimezone(): DateTimeZone { /* wp_timezone() */ }
    public function formatLocalized(DateTimeImmutable $i, string $f): string { /* wp_date() */ }
    public function relative(DateTimeImmutable $i): string { /* human_time_diff() */ }
}
```

A hypothetical `phpnomad/carbon-integration` would ship a class implementing the much broader Carbon-backed cluster (predicates, arithmetic, boundaries, diff, parsing, formatting). A consumer that needs WordPress's timezone alongside Carbon's diff math binds each interface to the appropriate concrete.

## Why a catalog of narrow interfaces

A single fat `TimeStrategy` interface would force every integrator to implement methods their underlying library does not naturally support. A catalog of narrow interfaces lets integrators declare exactly what their library covers, and lets consumers depend only on the capabilities they use. Integrations declare PHPNomad support by implementing the relevant interfaces; consumers compose multiple integrations across libraries as needed.

## License

[MIT](LICENSE.txt)
