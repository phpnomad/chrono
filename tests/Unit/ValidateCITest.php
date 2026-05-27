<?php

namespace PHPNomad\Chrono\Tests\Unit;

use PHPNomad\Chrono\Interfaces\ClockStrategy;
use PHPNomad\Chrono\Interfaces\HasCreatedDate;
use PHPNomad\Chrono\Interfaces\HasExpiration;
use PHPNomad\Chrono\Interfaces\HasModifiedDate;
use PHPUnit\Framework\TestCase;
use Psr\Clock\ClockInterface;

final class ValidateCITest extends TestCase
{
    public function testClockStrategyExtendsPsr20(): void
    {
        $this->assertTrue(is_subclass_of(ClockStrategy::class, ClockInterface::class));
    }

    public function testCapabilityInterfacesLoad(): void
    {
        $this->assertTrue(interface_exists(HasExpiration::class));
        $this->assertTrue(interface_exists(HasCreatedDate::class));
        $this->assertTrue(interface_exists(HasModifiedDate::class));
    }
}
