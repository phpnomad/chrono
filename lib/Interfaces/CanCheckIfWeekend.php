<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether a given instant falls on a weekend day.
 *
 * Whether "weekend" means Saturday and Sunday or follows a regional
 * convention (e.g. Friday and Saturday) is the implementation's choice.
 */
interface CanCheckIfWeekend
{
    public function isWeekend(DateTimeImmutable $instant): bool;
}
