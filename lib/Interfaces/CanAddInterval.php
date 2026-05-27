<?php

namespace PHPNomad\Chrono\Interfaces;

use DateInterval;
use DateTimeImmutable;

/**
 * Adds a DateInterval to a given instant and returns the resulting instant.
 *
 * Equivalent to DateTimeImmutable::add() but the implementation may
 * apply safer month-boundary policies than the native behavior.
 */
interface CanAddInterval
{
    public function add(DateTimeImmutable $instant, DateInterval $interval): DateTimeImmutable;
}
