<?php

namespace PHPNomad\Chrono\Interfaces;

use Psr\Clock\ClockInterface;

/**
 * Strategy for resolving the current point in time.
 *
 * Extends PSR-20 so any PSR-20 implementation (lcobucci/clock, symfony/clock,
 * test doubles) is structurally compatible without an adapter.
 */
interface ClockStrategy extends ClockInterface
{
}
