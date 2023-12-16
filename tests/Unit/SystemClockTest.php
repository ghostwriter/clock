<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Tests\Unit;

use DateTimeZone;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;
use Ghostwriter\Clock\Trait\ClockTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ClockTrait::class)]
#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class SystemClockTest extends TestCase
{
    public function testDefaultTimezone(): void
    {
        $clock = SystemClock::new();

        $now = $clock->now();

        self::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    public function testFreeze(): void
    {
        $clock = SystemClock::new();

        $now = $clock->now();

        $frozen = $clock->freeze();

        self::assertInstanceOf(SystemClock::class, $clock);

        self::assertInstanceOf(FrozenClock::class, $frozen);

        self::assertSame($now->getTimestamp(), $frozen->now()->getTimestamp());
    }

    public function testInstanceOfClockInterface(): void
    {
        $clock = SystemClock::new();

        self::assertInstanceOf(ClockInterface::class, $clock);
        self::assertInstanceOf(SystemClockInterface::class, $clock);
        self::assertInstanceOf(SystemClock::class, $clock);
    }

    public function testNow(): void
    {
        $clock = SystemClock::new();

        self::assertNotSame($clock->now(), $clock->now());
    }

    public function testWithDateTimeZone(): void
    {
        $timezone = new DateTimeZone('Africa/Addis_Ababa');

        $clock = SystemClock::new()->withDateTimeZone($timezone);

        self::assertInstanceOf(LocalizedClockInterface::class, $clock);

        self::assertInstanceOf(LocalizedClock::class, $clock);

        $now = $clock->now();

        self::assertSame($timezone->getName(), $now->getTimezone()->getName());
    }

    public function testWithTimezone(): void
    {
        $timezone = 'Africa/Addis_Ababa';

        $now = SystemClock::new()->withTimezone($timezone)->now();

        self::assertSame($timezone, $now->getTimezone()->getName());
    }
}
