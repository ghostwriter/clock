<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Tests\Unit;

use DateTimeZone;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
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
final class LocalizedClockTest extends TestCase
{
    public function testDefaultUTCTimezone(): void
    {
        $clock = LocalizedClock::new();

        $now = $clock->now();

        self::assertSame('UTC', $now->getTimezone()->getName());
    }

    public function testFreeze(): void
    {
        $clock = LocalizedClock::new();

        $now = $clock->now();

        $frozen = $clock->freeze();

        self::assertInstanceOf(LocalizedClock::class, $clock);

        self::assertInstanceOf(FrozenClockInterface::class, $frozen);
        self::assertInstanceOf(FrozenClock::class, $frozen);

        self::assertSame($now->getTimestamp(), $frozen->now()->getTimestamp());
    }

    public function testInstanceOfClockInterface(): void
    {
        $clock = LocalizedClock::new();

        self::assertInstanceOf(ClockInterface::class, $clock);
        self::assertInstanceOf(LocalizedClockInterface::class, $clock);
        self::assertInstanceOf(LocalizedClock::class, $clock);
    }

    public function testNow(): void
    {
        $clock = LocalizedClock::new();

        self::assertNotSame($clock->now(), $clock->now());
    }

    public function testWithDateTimeZone(): void
    {
        $timezone = new DateTimeZone('Africa/Addis_Ababa');

        $clock = LocalizedClock::new()->withDateTimeZone($timezone);

        self::assertInstanceOf(LocalizedClockInterface::class, $clock);

        self::assertInstanceOf(LocalizedClock::class, $clock);

        $now = $clock->now();

        self::assertSame($timezone->getName(), $now->getTimezone()->getName());
    }

    public function testWithSystemTimezone(): void
    {
        $clock = LocalizedClock::new()->withSystemTimezone();

        self::assertInstanceOf(SystemClockInterface::class, $clock);

        self::assertInstanceOf(SystemClock::class, $clock);

        $now = $clock->now();

        self::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    public function testWithTimezone(): void
    {
        $timezone = 'Africa/Addis_Ababa';

        $now = LocalizedClock::new()->withTimezone($timezone)->now();

        self::assertSame($timezone, $now->getTimezone()->getName());
    }
}
