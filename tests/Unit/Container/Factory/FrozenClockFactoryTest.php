<?php

declare(strict_types=1);

namespace Tests\Unit\Container\Factory;

use Ghostwriter\Clock\Container\Factory\FrozenClockFactory;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

use Throwable;

use function is_a;

#[CoversClass(FrozenClockFactory::class)]
final class FrozenClockFactoryTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsGhostwriterContainerInterfaceServiceFactoryInterface(): void
    {
        self::assertTrue(is_a(FrozenClockFactory::class, FactoryInterface::class, true));
    }
}
