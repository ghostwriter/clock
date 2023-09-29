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
        $clock = new LocalizedClock();

        $now = $clock->now();

        static::assertSame('UTC', $now->getTimezone()->getName());
    }

    public function testFreeze(): void
    {
        $clock = new LocalizedClock();

        $now = $clock->now();

        $frozen = $clock->freeze();

        static::assertInstanceOf(LocalizedClock::class, $clock);

        static::assertInstanceOf(FrozenClockInterface::class, $frozen);
        static::assertInstanceOf(FrozenClock::class, $frozen);

        static::assertSame($now->getTimestamp(), $frozen->now()->getTimestamp());
    }

    public function testInstanceOfClockInterface(): void
    {
        $clock = new LocalizedClock();

        static::assertInstanceOf(ClockInterface::class, $clock);
        static::assertInstanceOf(LocalizedClockInterface::class, $clock);
        static::assertInstanceOf(LocalizedClock::class, $clock);
    }

    public function testNow(): void
    {
        $clock = new LocalizedClock();

        static::assertNotSame($clock->now(), $clock->now());
    }

    public function testWithDateTimeZone(): void
    {
        $timezone = new DateTimeZone('Africa/Addis_Ababa');

        $clock = LocalizedClock::withDateTimezone($timezone);

        static::assertInstanceOf(LocalizedClockInterface::class, $clock);

        static::assertInstanceOf(LocalizedClock::class, $clock);

        $now = $clock->now();

        static::assertSame($timezone->getName(), $now->getTimezone()->getName());
    }

    public function testWithSystemTimezone(): void
    {
        $clock = LocalizedClock::withSystemTimezone();

        static::assertInstanceOf(SystemClockInterface::class, $clock);

        static::assertInstanceOf(SystemClock::class, $clock);

        $now = $clock->now();

        static::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    public function testWithTimezone(): void
    {
        $timezone = 'Africa/Addis_Ababa';

        $now = LocalizedClock::withTimezone($timezone)->now();

        static::assertSame($timezone, $now->getTimezone()->getName());
    }
}
