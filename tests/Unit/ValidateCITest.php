<?php

namespace PHPNomad\Chrono\Tests\Unit;

use PHPNomad\Chrono\Interfaces\CanAddInterval;
use PHPNomad\Chrono\Interfaces\CanApplyModifier;
use PHPNomad\Chrono\Interfaces\CanCheckBetween;
use PHPNomad\Chrono\Interfaces\CanCheckIfFuture;
use PHPNomad\Chrono\Interfaces\CanCheckIfPast;
use PHPNomad\Chrono\Interfaces\CanCheckIfWeekday;
use PHPNomad\Chrono\Interfaces\CanCheckIfWeekend;
use PHPNomad\Chrono\Interfaces\CanCheckSameDay;
use PHPNomad\Chrono\Interfaces\CanCheckSameMonth;
use PHPNomad\Chrono\Interfaces\CanCheckSameYear;
use PHPNomad\Chrono\Interfaces\CanFormatDate;
use PHPNomad\Chrono\Interfaces\CanFormatLocalizedDate;
use PHPNomad\Chrono\Interfaces\CanFormatRelativeTime;
use PHPNomad\Chrono\Interfaces\CanGetDifference;
use PHPNomad\Chrono\Interfaces\CanGetDifferenceInDays;
use PHPNomad\Chrono\Interfaces\CanGetDifferenceInHours;
use PHPNomad\Chrono\Interfaces\CanGetDifferenceInMinutes;
use PHPNomad\Chrono\Interfaces\CanGetDifferenceInSeconds;
use PHPNomad\Chrono\Interfaces\CanGetEndOfDay;
use PHPNomad\Chrono\Interfaces\CanGetEndOfMonth;
use PHPNomad\Chrono\Interfaces\CanGetEndOfYear;
use PHPNomad\Chrono\Interfaces\CanGetStartOfDay;
use PHPNomad\Chrono\Interfaces\CanGetStartOfMonth;
use PHPNomad\Chrono\Interfaces\CanGetStartOfYear;
use PHPNomad\Chrono\Interfaces\CanParseDate;
use PHPNomad\Chrono\Interfaces\CanParseDateWithFormat;
use PHPNomad\Chrono\Interfaces\CanSubtractInterval;
use PHPNomad\Chrono\Interfaces\ClockStrategy;
use PHPNomad\Chrono\Interfaces\HasCreatedDate;
use PHPNomad\Chrono\Interfaces\HasLocale;
use PHPNomad\Chrono\Interfaces\HasModifiedDate;
use PHPNomad\Chrono\Interfaces\HasTimezone;
use PHPUnit\Framework\TestCase;
use Psr\Clock\ClockInterface;

final class ValidateCITest extends TestCase
{
    public function testClockStrategyExtendsPsr20(): void
    {
        $this->assertTrue(is_subclass_of(ClockStrategy::class, ClockInterface::class));
    }

    /**
     * @dataProvider catalogProvider
     */
    public function testInterfaceLoads(string $interface): void
    {
        $this->assertTrue(interface_exists($interface));
    }

    public static function catalogProvider(): array
    {
        return [
            [ClockStrategy::class],
            [HasTimezone::class],
            [HasLocale::class],
            [HasCreatedDate::class],
            [HasModifiedDate::class],
            [CanCheckIfPast::class],
            [CanCheckIfFuture::class],
            [CanCheckIfWeekend::class],
            [CanCheckIfWeekday::class],
            [CanCheckSameDay::class],
            [CanCheckSameMonth::class],
            [CanCheckSameYear::class],
            [CanCheckBetween::class],
            [CanApplyModifier::class],
            [CanAddInterval::class],
            [CanSubtractInterval::class],
            [CanGetStartOfDay::class],
            [CanGetEndOfDay::class],
            [CanGetStartOfMonth::class],
            [CanGetEndOfMonth::class],
            [CanGetStartOfYear::class],
            [CanGetEndOfYear::class],
            [CanGetDifference::class],
            [CanGetDifferenceInDays::class],
            [CanGetDifferenceInHours::class],
            [CanGetDifferenceInMinutes::class],
            [CanGetDifferenceInSeconds::class],
            [CanParseDate::class],
            [CanParseDateWithFormat::class],
            [CanFormatDate::class],
            [CanFormatLocalizedDate::class],
            [CanFormatRelativeTime::class],
        ];
    }
}
