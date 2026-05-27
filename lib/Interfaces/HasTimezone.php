<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeZone;

/**
 * Provides the configured timezone for the platform or context.
 *
 * Implementations resolve the timezone from the platform's own
 * conventions — e.g. wp_timezone() on WordPress, or
 * date_default_timezone_get() on vanilla PHP.
 */
interface HasTimezone
{
    public function getTimezone(): DateTimeZone;
}
