<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Trait\ClockTrait;

/**
 * A clock that returns frozen time.
 *
 * @see \Ghostwriter\ClockTests\Unit\FrozenClockTest
 *
 * @immutable
 */
final readonly class FrozenClock implements FrozenClockInterface
{
    use ClockTrait;

    private function __construct(
        private DateTimeImmutable $dateTimeImmutable
    ) {}

    public function freeze(): FrozenClockInterface
    {
        return $this;
    }

    public static function new(DateTimeImmutable $dateTimeImmutable = new DateTimeImmutable()): self
    {
        return new self($dateTimeImmutable);
    }

    public function now(): DateTimeImmutable
    {
        return $this->dateTimeImmutable;
    }
}
