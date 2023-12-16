<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

use DateTimeZone;

interface LocalizedClockInterface extends ClockInterface
{
    public static function new(DateTimeZone $dateTimeZone): self;
}
