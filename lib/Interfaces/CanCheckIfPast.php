<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether a given instant has already occurred.
 *
 * Implementations typically inject a ClockStrategy via constructor
 * and compare the given instant against the current time.
 */
interface CanCheckIfPast
{
    public function isPast(DateTimeImmutable $instant): bool;
}
