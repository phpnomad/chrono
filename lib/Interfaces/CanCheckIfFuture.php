<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether a given instant lies in the future.
 *
 * Implementations typically inject a ClockStrategy via constructor
 * and compare the given instant against the current time.
 */
interface CanCheckIfFuture
{
    public function isFuture(DateTimeImmutable $instant): bool;
}
