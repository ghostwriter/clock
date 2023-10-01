<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\Trait\ClockTrait;

/**
 * A clock that returns the current time in the system timezone via `date_default_timezone_set()`.
 *
 * @see \Ghostwriter\Clock\Tests\Unit\SystemClockTest
 *
 * @uses ClockTrait
 *
 * @immutable
 */
final readonly class SystemClock implements SystemClockInterface
{
    use ClockTrait;

    public function __construct(
        private readonly DateTimeZone $timezone
    ) {
    }

    public static function create(): SystemClockInterface
    {
        return new self(new DateTimeZone(date_default_timezone_get()));
    }

    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->timezone);
    }
}