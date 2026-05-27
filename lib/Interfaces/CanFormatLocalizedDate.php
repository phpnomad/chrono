<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Formats an instant to a locale-aware string.
 *
 * Implementations resolve the current locale from the platform
 * (e.g. WordPress site language, IntlDateFormatter locale, Carbon
 * locale) and produce translated month and day names plus
 * regional conventions. Format string semantics are the
 * implementation's choice.
 */
interface CanFormatLocalizedDate
{
    public function formatLocalized(DateTimeImmutable $instant, string $format): string;
}
