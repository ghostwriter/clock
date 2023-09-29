<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Exception;

use Ghostwriter\Clock\Interface\ExceptionInterface;
use InvalidArgumentException;

final class UnsupportedClockException extends InvalidArgumentException implements ExceptionInterface
{
}
