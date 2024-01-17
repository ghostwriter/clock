<?php

declare(strict_types=1);

namespace Ghostwriter\ClockTests\Unit\Exception;

use BadMethodCallException;
use DateTimeZone;
use Ghostwriter\Clock\Exception\CannotChangeTimezoneOfFrozenClockException;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockExceptionInterface;
use Ghostwriter\ClockTests\Unit\AbstractTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(FrozenClock::class)]
#[CoversClass(CannotChangeTimezoneOfFrozenClockException::class)]
final class CannotChangeTimezoneOfFrozenClockExceptionTest extends AbstractTestCase
{
    public function testFrozenClockWithDateTimeZone(): void
    {
        $this->expectCannotChangeTimezoneOfFrozenClockException();

        FrozenClock::new()->withDateTimeZone(new DateTimeZone('Africa/Addis_Ababa'));
    }

    public function testFrozenClockWithSystemTimezone(): void
    {
        $this->expectCannotChangeTimezoneOfFrozenClockException();

        FrozenClock::new()->withSystemTimezone();
    }

    public function testFrozenClockWithTimezone(): void
    {
        $this->expectCannotChangeTimezoneOfFrozenClockException();

        FrozenClock::new()->withTimezone('Africa/Addis_Ababa');
    }

    private function expectCannotChangeTimezoneOfFrozenClockException(): void
    {
        $this->expectException(ClockExceptionInterface::class);
        $this->expectException(BadMethodCallException::class);
        $this->expectException(CannotChangeTimezoneOfFrozenClockException::class);
    }
}
