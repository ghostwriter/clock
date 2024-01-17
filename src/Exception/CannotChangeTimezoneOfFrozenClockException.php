<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Exception;

use BadMethodCallException;
use Ghostwriter\Clock\Interface\ClockExceptionInterface;

final class CannotChangeTimezoneOfFrozenClockException extends BadMethodCallException implements ClockExceptionInterface
{
}
