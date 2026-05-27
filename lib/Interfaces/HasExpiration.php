<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Capability for any model that can expire at a defined point in time.
 *
 * Implementers expose both the expiration instant and a clock-aware check.
 * Inject a ClockStrategy into isExpired() so the comparison can be
 * exercised deterministically in tests.
 */
interface HasExpiration
{
    public function getExpiresAt(): DateTimeImmutable;

    public function isExpired(ClockStrategy $clock): bool;
}
