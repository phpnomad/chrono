<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether a given instant falls on a weekday.
 *
 * Logical inverse of CanCheckIfWeekend. Whether "weekday" excludes
 * regional weekend days (e.g. Friday-Saturday) is the implementation's choice.
 */
interface CanCheckIfWeekday
{
    public function isWeekday(DateTimeImmutable $instant): bool;
}
