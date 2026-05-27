<?php

declare(strict_types=1);

namespace Tests\Unit;

use DateTimeZone;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Throwable;

use function is_a;

#[CoversClass(FrozenClock::class)]
#[CoversClass(LocalizedClock::class)]
#[CoversClass(SystemClock::class)]
final class LocalizedClockTest extends TestCase
{
    /** @throws Throwable */
    public function testDefaultUTCTimezone(): void
    {
        $localizedClock = LocalizedClock::new();

        $now = $localizedClock->now();

        self::assertSame('UTC', $now->getTimezone()->getName());
    }

    /** @throws Throwable */
    public function testFreeze(): void
    {
        $localizedClock = LocalizedClock::new();

        $now = $localizedClock->now();

        $frozenClock = $localizedClock->freeze();

        self::assertSame($now->getTimestamp(), $frozenClock->now()->getTimestamp());
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterClockInterfaceClockInterface(): void
    {
        self::assertTrue(is_a(LocalizedClock::class, ClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterClockInterfaceLocalizedClockInterface(): void
    {
        self::assertTrue(is_a(LocalizedClock::class, LocalizedClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testImplementsPsrClockClockInterface(): void
    {
        self::assertTrue(is_a(LocalizedClock::class, \Psr\Clock\ClockInterface::class, true));
    }

    /** @throws Throwable */
    public function testNew(): void
    {
        $dateTimeZone = new DateTimeZone('Africa/Addis_Ababa');

        $localizedClock = LocalizedClock::new($dateTimeZone);

        $now = $localizedClock->now();

        self::assertSame($dateTimeZone->getName(), $now->getTimezone()->getName());
    }

    /** @throws Throwable */
    public function testNow(): void
    {
        $localizedClock = LocalizedClock::new();

        self::assertNotSame($localizedClock->now(), $localizedClock->now());
    }
}
