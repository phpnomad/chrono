<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether a given instant lies between two other instants.
 *
 * Inclusivity of the boundaries is left to the implementation; document
 * the choice in concrete classes that need to be explicit.
 */
interface CanCheckBetween
{
    public function isBetween(
        DateTimeImmutable $instant,
        DateTimeImmutable $start,
        DateTimeImmutable $end
    ): bool;
}
