<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Returns an instant at the end of the given instant's calendar year
 * (December 31 at 23:59:59.999999 in the instant's timezone).
 */
interface CanGetEndOfYear
{
    public function endOfYear(DateTimeImmutable $instant): DateTimeImmutable;
}
