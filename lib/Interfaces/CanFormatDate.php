<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Formats an instant to a string using a format specifier.
 *
 * The format syntax matches PHP's DateTimeImmutable::format(). For
 * locale-aware formatting (translated month and day names, regional
 * conventions), implement CanFormatLocalizedDate instead.
 */
interface CanFormatDate
{
    public function format(DateTimeImmutable $instant, string $format): string;
}
