<?php

namespace PHPNomad\Chrono\Interfaces;

use DateInterval;
use DateTimeImmutable;

/**
 * Subtracts a DateInterval from a given instant and returns
 * the resulting instant.
 *
 * Equivalent to DateTimeImmutable::sub() but the implementation may
 * apply safer month-boundary policies than the native behavior.
 */
interface CanSubtractInterval
{
    public function subtract(DateTimeImmutable $instant, DateInterval $interval): DateTimeImmutable;
}
