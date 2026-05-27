<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

use DateTimeImmutable;

interface ClockInterface extends \Psr\Clock\ClockInterface
{
    public function freeze(): FrozenClockInterface;

    public function now(): DateTimeImmutable;
}
