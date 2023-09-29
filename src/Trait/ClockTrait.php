<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Trait;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Exception\UnsupportedClockException;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;

trait ClockTrait
{
    final public function freeze(): FrozenClockInterface
    {
        if ($this instanceof FrozenClockInterface) {
            return $this;
        }

        /** @var ClockInterface $this */
        return new FrozenClock($this->now());
    }

    public function now(): DateTimeImmutable
    {
        throw new UnsupportedClockException();
    }

    final public static function withDateTimeZone(DateTimeZone $timezone): LocalizedClockInterface
    {
        return new LocalizedClock($timezone);
    }

    final public static function withSystemTimezone(): SystemClockInterface
    {
        return new SystemClock();
    }

    final public static function withTimezone(string $timezone): LocalizedClockInterface
    {
        return new LocalizedClock(new DateTimeZone($timezone));
    }
}
