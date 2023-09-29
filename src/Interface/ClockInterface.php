<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Interface;

use DateTimeImmutable;

interface ClockInterface
{
    public function now(): DateTimeImmutable;
}
