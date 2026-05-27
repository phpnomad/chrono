<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Computes the difference between two instants in whole hours.
 *
 * The result is the total elapsed hours. A negative result indicates
 * $b is before $a.
 */
interface CanGetDifferenceInHours
{
    public function diffInHours(DateTimeImmutable $a, DateTimeImmutable $b): int;
}
