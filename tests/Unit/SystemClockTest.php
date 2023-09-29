<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Tests\Unit;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Exception\UnsupportedClockException;
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
    public function testClockTraitThrowsUnsupportedClockException(): void
    {
        $this->expectException(UnsupportedClockException::class);

        $clock = new class() implements SystemClockInterface {
            use ClockTrait;
        };

        static::assertInstanceOf(DateTimeImmutable::class, $clock->now());
    }

    public function testDefaultUTCTimezone(): void
    {
        $clock = SystemClock::create();

        $now = $clock->now();

        static::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    public function testFreeze(): void
    {
        $clock = new SystemClock(new DateTimeZone(date_default_timezone_get()));

        $now = $clock->now();

        $frozen = $clock->freeze();

        static::assertInstanceOf(SystemClock::class, $clock);

        static::assertInstanceOf(FrozenClock::class, $frozen);

        static::assertSame($now->getTimestamp(), $frozen->now()->getTimestamp());
    }

    public function testInstanceOfClockInterface(): void
    {
        $clock = new SystemClock(new DateTimeZone(date_default_timezone_get()));

        static::assertInstanceOf(ClockInterface::class, $clock);
        static::assertInstanceOf(SystemClockInterface::class, $clock);
        static::assertInstanceOf(SystemClock::class, $clock);
    }

    public function testNow(): void
    {
        $clock = new SystemClock(new DateTimeZone(date_default_timezone_get()));

        static::assertNotSame($clock->now(), $clock->now());
    }

    public function testWithDateTimeZone(): void
    {
        $timezone = new DateTimeZone('Africa/Addis_Ababa');

        $clock = SystemClock::withDateTimezone($timezone);

        static::assertInstanceOf(LocalizedClockInterface::class, $clock);

        static::assertInstanceOf(LocalizedClock::class, $clock);

        $now = $clock->now();

        static::assertSame($timezone->getName(), $now->getTimezone()->getName());
    }

    public function testWithSystemTimezone(): void
    {
        $clock = SystemClock::withSystemTimezone();

        static::assertInstanceOf(SystemClockInterface::class, $clock);

        static::assertInstanceOf(SystemClock::class, $clock);

        $now = $clock->now();

        static::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    public function testWithTimezone(): void
    {
        $timezone = 'Africa/Addis_Ababa';

        $now = SystemClock::withTimezone($timezone)->now();

        static::assertSame($timezone, $now->getTimezone()->getName());
    }
}
