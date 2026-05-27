<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Returns an instant at the end of the given instant's calendar month
 * (last day of the month at 23:59:59.999999 in the instant's timezone).
 */
interface CanGetEndOfMonth
{
    public function endOfMonth(DateTimeImmutable $instant): DateTimeImmutable;
}
