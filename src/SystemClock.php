<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\Trait\ClockTrait;

use function date_default_timezone_get;

/**
 * A clock that returns the current time in the system timezone via `date_default_timezone_set()`.
 *
 * @see \Ghostwriter\ClockTests\Unit\SystemClockTest
 *
 * @immutable
 */
final readonly class SystemClock implements SystemClockInterface
{
    use ClockTrait;

    public function __construct(
        private DateTimeZone $dateTimeZone
    ) {}

    public function freeze(): FrozenClockInterface
    {
        return FrozenClock::new($this->now());
    }

    public static function new(): SystemClockInterface
    {
        return new self(new DateTimeZone(date_default_timezone_get()));
    }

    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->dateTimeZone);
    }
}
