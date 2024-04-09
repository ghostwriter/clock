<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\Trait\ClockTrait;

/**
 * A clock that returns the current time in a given timezone.
 *
 * @see \Ghostwriter\ClockTests\Unit\LocalizedClockTest
 *
 * @immutable
 */
final readonly class LocalizedClock implements LocalizedClockInterface
{
    use ClockTrait;

    private function __construct(
        private DateTimeZone $dateTimeZone
    ) {}

    public function freeze(): FrozenClockInterface
    {
        return FrozenClock::new($this->now());
    }

    public static function new(DateTimeZone $dateTimeZone = new DateTimeZone('UTC')): self
    {
        return new self($dateTimeZone);
    }

    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->dateTimeZone);
    }
}
