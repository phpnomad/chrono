<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether two instants fall in the same calendar month.
 *
 * Both year and month must match. January 2025 and January 2026
 * return false.
 */
interface CanCheckSameMonth
{
    public function isSameMonth(DateTimeImmutable $a, DateTimeImmutable $b): bool;
}
