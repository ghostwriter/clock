<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

use DateTimeImmutable;
use DateTimeZone;

interface ClockInterface
{
    public function freeze(): FrozenClockInterface;

    public function now(): DateTimeImmutable;

    public function withDateTimeZone(DateTimeZone $dateTimeZone): LocalizedClockInterface;

    public function withSystemTimezone(): SystemClockInterface;

    /**
     * @param non-empty-string $timezone
     */
    public function withTimezone(string $timezone): LocalizedClockInterface;
}
