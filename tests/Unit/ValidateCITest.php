<?php

namespace PHPNomad\Chrono\Tests\Unit;

use PHPNomad\Chrono\Interfaces\ClockStrategy;
use PHPUnit\Framework\TestCase;
use Psr\Clock\ClockInterface;

final class ValidateCITest extends TestCase
{
    public function testClockStrategyExtendsPsr20(): void
    {
        $this->assertTrue(is_subclass_of(ClockStrategy::class, ClockInterface::class));
    }
}
