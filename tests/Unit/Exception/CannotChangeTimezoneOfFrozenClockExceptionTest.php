<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Tests\Unit\Exception;

use BadMethodCallException;
use DateTimeZone;
use Ghostwriter\Clock\Exception\CannotChangeTimezoneOfFrozenClockException;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ExceptionInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FrozenClock::class)]
#[CoversClass(CannotChangeTimezoneOfFrozenClockException::class)]
final class CannotChangeTimezoneOfFrozenClockExceptionTest extends TestCase
{
    public function testFrozenClockWithDateTimeZone(): void
    {
        $this->expectException(ExceptionInterface::class);
        $this->expectException(BadMethodCallException::class);
        $this->expectException(CannotChangeTimezoneOfFrozenClockException::class);

        FrozenClock::new()->withDateTimeZone(new DateTimeZone('Africa/Addis_Ababa'));
    }

    public function testFrozenClockWithSystemTimezone(): void
    {
        $this->expectException(ExceptionInterface::class);
        $this->expectException(BadMethodCallException::class);
        $this->expectException(CannotChangeTimezoneOfFrozenClockException::class);

        FrozenClock::new()->withSystemTimezone();
    }

    public function testFrozenClockWithTimezone(): void
    {
        $this->expectException(ExceptionInterface::class);
        $this->expectException(BadMethodCallException::class);
        $this->expectException(CannotChangeTimezoneOfFrozenClockException::class);

        FrozenClock::new()->withTimezone('Africa/Addis_Ababa');
    }
}
