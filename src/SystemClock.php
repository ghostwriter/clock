<?php

declare(strict_types=1);

namespace Ghostwriter\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Override;
use Tests\Unit\SystemClockTest;
use Throwable;

use function date_default_timezone_get;

/**
 * A clock that returns the current time in the system timezone via `date_default_timezone_set()`.
 *
 * @see SystemClockTest
 *
 * @immutable
 */
final readonly class SystemClock implements SystemClockInterface
{
    public function __construct(
        private DateTimeZone $dateTimeZone
    ) {}

    /**
     * @throws Throwable
     */
    #[Override]
    public static function new(): SystemClockInterface
    {
        return new self(new DateTimeZone(date_default_timezone_get()));
    }

    /**
     * @throws Throwable
     */
    #[Override]
    public function freeze(): FrozenClockInterface
    {
        return FrozenClock::new($this->now());
    }

    /**
     * @throws Throwable
     */
    #[Override]
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->dateTimeZone);
    }
}
