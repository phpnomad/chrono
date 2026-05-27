<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Formats an instant as a human-readable relative-time string,
 * e.g. "3 hours ago" or "in 2 days".
 *
 * Implementations resolve the comparison time from an injected
 * ClockStrategy (or equivalent) and the localized phrasing from
 * the platform (WordPress human_time_diff, Carbon diffForHumans, etc.).
 */
interface CanFormatRelativeTime
{
    public function relative(DateTimeImmutable $instant): string;
}
