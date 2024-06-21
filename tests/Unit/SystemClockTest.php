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

#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class SystemClockTest extends TestCase
{
    /**
     * @throws Throwable
     */
    public function testDefaultTimezone(): void
    {
        $clock = SystemClock::new();

        $now = $clock->now();

        self::assertSame(date_default_timezone_get(), $now->getTimezone()->getName());
    }

    /**
     * @throws Throwable
     */
    public function testFreeze(): void
    {
        $clock = SystemClock::new();

        $now = $clock->now();

        $frozen = $clock->freeze();

        self::assertInstanceOf(SystemClock::class, $clock);

        self::assertInstanceOf(FrozenClock::class, $frozen);

        self::assertSame($now->getTimestamp(), $frozen->now()->getTimestamp());
    }

    /**
     * @throws Throwable
     */
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
}
