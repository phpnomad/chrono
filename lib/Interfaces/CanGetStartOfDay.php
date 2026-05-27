<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Returns an instant at the start of the given instant's calendar day
 * (00:00:00.000 in the instant's timezone).
 */
interface CanGetStartOfDay
{
    public function startOfDay(DateTimeImmutable $instant): DateTimeImmutable;
}
