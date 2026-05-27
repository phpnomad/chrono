<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Applies a relative date string (e.g. "+1 day", "next monday")
 * to a given instant and returns the resulting instant.
 *
 * Native PHP's DateTimeImmutable::modify() has surprising behavior
 * at month boundaries (e.g. Jan 31 + "1 month" gives March 3).
 * Implementations are free to apply safer policies (Carbon's
 * overflow handling, Tokei's clamp-to-month-end, etc.).
 */
interface CanApplyModifier
{
    public function apply(DateTimeImmutable $instant, string $modifier): DateTimeImmutable;
}
