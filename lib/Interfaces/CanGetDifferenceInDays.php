<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Computes the difference between two instants in whole days.
 *
 * The result is the total elapsed days, not just the day component
 * of a DateInterval. A negative result indicates $b is before $a.
 */
interface CanGetDifferenceInDays
{
    public function diffInDays(DateTimeImmutable $a, DateTimeImmutable $b): int;
}
