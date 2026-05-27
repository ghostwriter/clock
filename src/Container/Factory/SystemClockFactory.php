<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Container\Factory;

use Ghostwriter\Clock\SystemClock;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Override;
use Throwable;

/**
 * @see SystemClockFactoryTest
 *
 * @implements FactoryInterface<SystemClock>
 */
final readonly class SystemClockFactory implements FactoryInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): SystemClock
    {
        return SystemClock::new();
    }
}
