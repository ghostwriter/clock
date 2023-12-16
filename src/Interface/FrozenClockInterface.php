<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

use DateTimeImmutable;

interface FrozenClockInterface extends ClockInterface
{
    public static function new(DateTimeImmutable $dateTimeImmutable): self;
}
