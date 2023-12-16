<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Trait;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Exception\CannotChangeTimezoneOfFrozenClockException;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;

trait ClockTrait
{
    abstract public function now(): DateTimeImmutable;
    abstract public function freeze(): FrozenClockInterface;

    /**
     * @throws CannotChangeTimezoneOfFrozenClockException
     */
    final public function withDateTimeZone(DateTimeZone $timezone): LocalizedClockInterface
    {
        return match (true) {
            $this instanceof FrozenClockInterface => throw new CannotChangeTimezoneOfFrozenClockException(),
            default => LocalizedClock::new($timezone)
        };
    }

    /**
     * @param non-empty-string $timezone
     * @throws CannotChangeTimezoneOfFrozenClockException
     */
    final public function withTimezone(string $timezone): LocalizedClockInterface
    {
        return match (true) {
            $this instanceof FrozenClockInterface => throw new CannotChangeTimezoneOfFrozenClockException(),
            default => LocalizedClock::new(new DateTimeZone($timezone))
        };
    }

    /**
     * @throws CannotChangeTimezoneOfFrozenClockException
     */
    final public function withSystemTimezone(): SystemClockInterface
    {
        return match (true) {
            $this instanceof FrozenClockInterface => throw new CannotChangeTimezoneOfFrozenClockException(),
            default => SystemClock::new()
        };
    }
}
