<?php

namespace PHPNomad\Chrono\Interfaces;

use DateInterval;
use DateTimeImmutable;

/**
 * Computes the calendar-aware difference between two instants.
 *
 * Returns a DateInterval describing the years, months, days, hours,
 * minutes, and seconds between the two instants. Direction is encoded
 * by DateInterval::$invert.
 */
interface CanGetDifference
{
    public function diff(DateTimeImmutable $a, DateTimeImmutable $b): DateInterval;
}
