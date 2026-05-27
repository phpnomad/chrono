<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Computes the difference between two instants in whole minutes.
 *
 * The result is the total elapsed minutes. A negative result indicates
 * $b is before $a.
 */
interface CanGetDifferenceInMinutes
{
    public function diffInMinutes(DateTimeImmutable $a, DateTimeImmutable $b): int;
}
