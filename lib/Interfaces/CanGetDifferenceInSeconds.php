<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Computes the difference between two instants in whole seconds.
 *
 * The result is the total elapsed seconds. A negative result indicates
 * $b is before $a.
 */
interface CanGetDifferenceInSeconds
{
    public function diffInSeconds(DateTimeImmutable $a, DateTimeImmutable $b): int;
}
