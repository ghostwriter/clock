<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Override;

/**
 * A clock that returns frozen time.
 *
 * @see \Tests\Unit\FrozenClockTest
 *
 * @immutable
 */
final readonly class FrozenClock implements FrozenClockInterface
{
    private function __construct(
        private DateTimeImmutable $dateTimeImmutable
    ) {
    }

    #[Override]
    public function freeze(): FrozenClockInterface
    {
        return $this;
    }

    #[Override]
    public function now(): DateTimeImmutable
    {
        return $this->dateTimeImmutable;
    }

    #[Override]
    public static function new(DateTimeImmutable $dateTimeImmutable = new DateTimeImmutable()): self
    {
        return new self($dateTimeImmutable);
    }
}
