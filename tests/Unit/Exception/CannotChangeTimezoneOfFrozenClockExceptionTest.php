<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use BadMethodCallException;
use DateTimeZone;
use Ghostwriter\Clock\Exception\CannotChangeTimezoneOfFrozenClockException;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockExceptionInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

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
