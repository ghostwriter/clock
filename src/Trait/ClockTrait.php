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
use Override;

trait ClockTrait
{
    #[Override]
    final public function withDateTimeZone(DateTimeZone $dateTimeZone): LocalizedClockInterface
    {
        return match (true) {
            $this instanceof FrozenClockInterface => throw new CannotChangeTimezoneOfFrozenClockException(),
            default => LocalizedClock::new($dateTimeZone)
        };
    }

    #[Override]
    final public function withSystemTimezone(): SystemClockInterface
    {
        return match (true) {
            $this instanceof FrozenClockInterface => throw new CannotChangeTimezoneOfFrozenClockException(),
            default => SystemClock::new()
        };
    }

    /**
     * @param non-empty-string $timezone
     */
    #[Override]
    final public function withTimezone(string $timezone): LocalizedClockInterface
    {
        return match (true) {
            $this instanceof FrozenClockInterface => throw new CannotChangeTimezoneOfFrozenClockException(),
            default => LocalizedClock::new(new DateTimeZone($timezone))
        };
    }

    #[Override]
    abstract public function freeze(): FrozenClockInterface;

    #[Override]
    abstract public function now(): DateTimeImmutable;
}
