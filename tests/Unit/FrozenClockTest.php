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

use function is_a;

#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class FrozenClockTest extends TestCase
{
    /** @throws Throwable */
    public function testDefaultTimezone(): void
    {
        $now = FrozenClock::new()->now();

        self::assertSame('UTC', $now->getTimezone()->getName());
    }

    /** @throws Throwable */
    public function testFreeze(): void
    {
        $frozenClock = FrozenClock::new();

        self::assertInstanceOf(FrozenClock::class, $frozenClock);

        $now = $frozenClock->now();

        $frozen = $frozenClock->freeze();

        self::assertSame($frozenClock, $frozen);

        $frozenNow = $frozen->now();

        self::assertSame($now, $frozenNow);
        self::assertSame($now->getTimestamp(), $frozenNow->getTimestamp());
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterClockInterfaceClockInterface(): void
    {
        self::assertTrue(is_a(FrozenClock::class, ClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterClockInterfaceFrozenClockInterface(): void
    {
        self::assertTrue(is_a(FrozenClock::class, FrozenClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testImplementsPsrClockClockInterface(): void
    {
        self::assertTrue(is_a(FrozenClock::class, \Psr\Clock\ClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testNow(): void
    {
        $frozenClock = FrozenClock::new();

        self::assertSame($frozenClock->now(), $frozenClock->now());
    }
}
