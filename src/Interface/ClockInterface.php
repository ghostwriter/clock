<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

use DateTimeImmutable;
use DateTimeZone;

interface ClockInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function freeze(): FrozenClockInterface;

    public function now(): DateTimeImmutable;

    /**
     * @throws ExceptionInterface
     */
    public function withDateTimeZone(DateTimeZone $dateTimeZone): LocalizedClockInterface;

    /**
     * @throws ExceptionInterface
     */
    public function withSystemTimezone(): SystemClockInterface;

    /**
     * @param non-empty-string $timezone
     * @throws ExceptionInterface
     */
    public function withTimezone(string $timezone): LocalizedClockInterface;
}
