<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Capability for any model that records when it was created.
 *
 * Implementers should receive the created date from an injected
 * ClockStrategy at construction time rather than constructing
 * DateTime objects directly.
 */
interface HasCreatedDate
{
    public function getCreatedDate(): DateTimeImmutable;
}
