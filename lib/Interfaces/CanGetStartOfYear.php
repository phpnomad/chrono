<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Returns an instant at the start of the given instant's calendar year
 * (January 1 at 00:00:00.000 in the instant's timezone).
 */
interface CanGetStartOfYear
{
    public function startOfYear(DateTimeImmutable $instant): DateTimeImmutable;
}
