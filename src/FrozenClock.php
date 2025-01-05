<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Override;
use Tests\Unit\FrozenClockTest;

/**
 * A clock that returns frozen time.
 *
 * @see FrozenClockTest
 *
 * @immutable
 */
final readonly class FrozenClock implements FrozenClockInterface
{
    private function __construct(
        private DateTimeImmutable $dateTimeImmutable
    ) {}

    #[Override]
    public static function new(DateTimeImmutable $dateTimeImmutable = new DateTimeImmutable()): self
    {
        return new self($dateTimeImmutable);
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
}
