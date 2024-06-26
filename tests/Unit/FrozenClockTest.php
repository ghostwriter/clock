<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;

#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class FrozenClockTest extends TestCase
{
    /**
     * @throws Throwable
     */
    public function testDefaultTimezone(): void
    {
        $now = FrozenClock::new()->now();

        self::assertSame('UTC', $now->getTimezone()->getName());
    }

    /**
     * @throws Throwable
     */
    public function testFreeze(): void
    {
        $clock = FrozenClock::new();

        $now = $clock->now();

        $frozen = $clock->freeze();

        $frozenNow = $frozen->now();

        self::assertInstanceOf(FrozenClock::class, $clock);
        self::assertInstanceOf(FrozenClockInterface::class, $frozen);
        self::assertInstanceOf(FrozenClock::class, $frozen);

        self::assertSame($clock, $frozen);
        self::assertSame($now, $frozenNow);
        self::assertSame($now->getTimestamp(), $frozenNow->getTimestamp());
    }

    /**
     * @throws Throwable
     */
    public function testInstanceOfClockInterface(): void
    {
        $clock = FrozenClock::new();

        self::assertInstanceOf(ClockInterface::class, $clock);
        self::assertInstanceOf(FrozenClockInterface::class, $clock);
        self::assertInstanceOf(FrozenClock::class, $clock);
    }

    /**
     * @throws Throwable
     */
    public function testNow(): void
    {
        $clock = FrozenClock::new();

        self::assertSame($clock->now(), $clock->now());
    }
}
