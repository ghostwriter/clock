<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\Trait\ClockTrait;

/**
 * A clock that returns the current time in a given timezone.
 *
 * @see \Ghostwriter\Clock\Tests\Unit\LocalizedClockTest
 *
 * @uses ClockTrait
 *
 * @immutable
 */
final readonly class LocalizedClock implements LocalizedClockInterface
{
    use ClockTrait;

    public function __construct(
        private readonly DateTimeZone $timezone = new DateTimeZone('UTC')
    ) {
    }

    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->timezone);
    }
}
