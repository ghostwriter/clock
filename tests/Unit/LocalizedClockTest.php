<?php

declare(strict_types=1);

namespace Tests\Unit;

use DateTimeZone;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;

#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class LocalizedClockTest extends TestCase
{
    /**
     * @throws Throwable
     */
    public function testDefaultUTCTimezone(): void
    {
        $clock = LocalizedClock::new();

        $now = $clock->now();

        self::assertSame('UTC', $now->getTimezone()->getName());
    }

    /**
     * @throws Throwable
     */
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

    /**
     * @throws Throwable
     */
    public function testInstanceOfClockInterface(): void
    {
        $clock = LocalizedClock::new();

        self::assertInstanceOf(ClockInterface::class, $clock);
        self::assertInstanceOf(LocalizedClockInterface::class, $clock);
        self::assertInstanceOf(LocalizedClock::class, $clock);
    }

    /**
     * @throws Throwable
     */
    public function testNew(): void
    {
        $timezone = new DateTimeZone('Africa/Addis_Ababa');

        $clock = LocalizedClock::new($timezone);

        self::assertInstanceOf(LocalizedClockInterface::class, $clock);

        self::assertInstanceOf(LocalizedClock::class, $clock);

        $now = $clock->now();

        self::assertSame($timezone->getName(), $now->getTimezone()->getName());
    }

    /**
     * @throws Throwable
     */
    public function testNow(): void
    {
        $clock = LocalizedClock::new();

        self::assertNotSame($clock->now(), $clock->now());
    }
}
