<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Reports whether two instants fall on the same calendar day.
 *
 * The comparison is calendar-day based, not 24-hour-window based:
 * 23:59 and 00:01 of consecutive days return false even though
 * they are only two minutes apart.
 */
interface CanCheckSameDay
{
    public function isSameDay(DateTimeImmutable $a, DateTimeImmutable $b): bool;
}
