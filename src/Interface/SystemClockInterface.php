<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

interface SystemClockInterface extends ClockInterface
{
    public static function new(): self;
}
