<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether two instants fall in the same calendar year.
 */
interface CanCheckSameYear
{
    public function isSameYear(DateTimeImmutable $a, DateTimeImmutable $b): bool;
}
