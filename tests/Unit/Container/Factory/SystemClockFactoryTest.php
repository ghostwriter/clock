<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Factory;

use Ghostwriter\Clock\Container\Factory\SystemClockFactory;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

use Throwable;

use function is_a;

#[CoversClass(SystemClockFactory::class)]
final class SystemClockFactoryTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsGhostwriterContainerInterfaceServiceFactoryInterface(): void
    {
        self::assertTrue(is_a(SystemClockFactory::class, FactoryInterface::class, true));
    }
}
