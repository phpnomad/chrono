<?php

namespace PHPNomad\Chrono\Interfaces;

/**
 * Provides the configured locale for the platform or context.
 *
 * Implementations resolve the locale from the platform's own
 * conventions — e.g. determine_locale() on WordPress, the
 * IntlDateFormatter default elsewhere — and return it as the
 * BCP 47 / POSIX-style string that downstream consumers
 * (Carbon, Intl, etc.) expect.
 */
interface HasLocale
{
    public function getLocale(): string;
}
