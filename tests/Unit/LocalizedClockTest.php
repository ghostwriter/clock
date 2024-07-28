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
        $localizedClock = LocalizedClock::new();

        $now = $localizedClock->now();

        self::assertSame('UTC', $now->getTimezone()->getName());
    }

    /**
     * @throws Throwable
     */
    public function testFreeze(): void
    {
        $localizedClock = LocalizedClock::new();

        $now = $localizedClock->now();

        $frozenClock = $localizedClock->freeze();

        self::assertInstanceOf(LocalizedClock::class, $localizedClock);

        self::assertInstanceOf(FrozenClockInterface::class, $frozenClock);
        self::assertInstanceOf(FrozenClock::class, $frozenClock);

        self::assertSame($now->getTimestamp(), $frozenClock->now()->getTimestamp());
    }

    /**
     * @throws Throwable
     */
    public function testInstanceOfClockInterface(): void
    {
        $localizedClock = LocalizedClock::new();

        self::assertInstanceOf(ClockInterface::class, $localizedClock);
        self::assertInstanceOf(LocalizedClockInterface::class, $localizedClock);
        self::assertInstanceOf(LocalizedClock::class, $localizedClock);
    }

    /**
     * @throws Throwable
     */
    public function testNew(): void
    {
        $dateTimeZone = new DateTimeZone('Africa/Addis_Ababa');

        $localizedClock = LocalizedClock::new($dateTimeZone);

        self::assertInstanceOf(LocalizedClockInterface::class, $localizedClock);

        self::assertInstanceOf(LocalizedClock::class, $localizedClock);

        $now = $localizedClock->now();

        self::assertSame($dateTimeZone->getName(), $now->getTimezone()->getName());
    }

    /**
     * @throws Throwable
     */
    public function testNow(): void
    {
        $localizedClock = LocalizedClock::new();

        self::assertNotSame($localizedClock->now(), $localizedClock->now());
    }
}
