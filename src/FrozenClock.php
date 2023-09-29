<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Trait\ClockTrait;

/**
 * A clock that returns frozen time.
 *
 * @see \Ghostwriter\Clock\Tests\Unit\FrozenClockTest
 *
 * @uses ClockTrait
 *
 * @immutable
 */
final readonly class FrozenClock implements FrozenClockInterface
{
    use ClockTrait;

    public function __construct(
        private readonly DateTimeImmutable $now = new DateTimeImmutable()
    ) {
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }
}
