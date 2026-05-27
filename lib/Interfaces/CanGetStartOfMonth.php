<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Returns an instant at the start of the given instant's calendar month
 * (first day of the month at 00:00:00.000 in the instant's timezone).
 */
interface CanGetStartOfMonth
{
    public function startOfMonth(DateTimeImmutable $instant): DateTimeImmutable;
}
