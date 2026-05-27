<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Returns an instant at the end of the given instant's calendar day
 * (23:59:59.999999 in the instant's timezone).
 */
interface CanGetEndOfDay
{
    public function endOfDay(DateTimeImmutable $instant): DateTimeImmutable;
}
