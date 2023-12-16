<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Exception;

use Ghostwriter\Clock\Interface\ExceptionInterface;
use BadMethodCallException;

final class CannotChangeTimezoneOfFrozenClockException extends BadMethodCallException implements ExceptionInterface
{
}
