<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Capability for any model that records when it was last modified.
 *
 * Implementers should receive the modified date from an injected
 * ClockStrategy when the record is written rather than constructing
 * DateTime objects directly.
 */
interface HasModifiedDate
{
    public function getModifiedDate(): DateTimeImmutable;
}
