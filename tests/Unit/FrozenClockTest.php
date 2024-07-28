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
        $frozenClock = FrozenClock::new();

        $now = $frozenClock->now();

        $frozen = $frozenClock->freeze();

        $frozenNow = $frozen->now();

        self::assertInstanceOf(FrozenClock::class, $frozenClock);
        self::assertInstanceOf(FrozenClockInterface::class, $frozen);
        self::assertInstanceOf(FrozenClock::class, $frozen);

        self::assertSame($frozenClock, $frozen);
        self::assertSame($now, $frozenNow);
        self::assertSame($now->getTimestamp(), $frozenNow->getTimestamp());
    }

    /**
     * @throws Throwable
     */
    public function testInstanceOfClockInterface(): void
    {
        $frozenClock = FrozenClock::new();

        self::assertInstanceOf(ClockInterface::class, $frozenClock);
        self::assertInstanceOf(FrozenClockInterface::class, $frozenClock);
        self::assertInstanceOf(FrozenClock::class, $frozenClock);
    }

    /**
     * @throws Throwable
     */
    public function testNow(): void
    {
        $frozenClock = FrozenClock::new();

        self::assertSame($frozenClock->now(), $frozenClock->now());
    }
}
