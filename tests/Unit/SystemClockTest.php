<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;

use function date_default_timezone_get;
use function is_a;

#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class SystemClockTest extends TestCase
{
    /** @throws Throwable */
    public function testDefaultTimezone(): void
    {
        $systemClock = SystemClock::new();

        $now = $systemClock->now();

        self::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    /** @throws Throwable */
    public function testFreeze(): void
    {
        $systemClock = SystemClock::new();

        $now = $systemClock->now();

        $frozenClock = $systemClock->freeze();

        self::assertInstanceOf(SystemClock::class, $systemClock);

        self::assertInstanceOf(FrozenClock::class, $frozenClock);

        self::assertSame($now->getTimestamp(), $frozenClock->now()->getTimestamp());
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterClockInterfaceClockInterface(): void
    {
        self::assertTrue(is_a(SystemClock::class, ClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterClockInterfaceSystemClockInterface(): void
    {
        self::assertTrue(is_a(SystemClock::class, SystemClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testImplementsPsrClockClockInterface(): void
    {
        self::assertTrue(is_a(SystemClock::class, \Psr\Clock\ClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testNow(): void
    {
        $systemClock = SystemClock::new();

        self::assertNotSame($systemClock->now(), $systemClock->now());
    }
}
