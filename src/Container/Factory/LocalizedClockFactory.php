<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Container\Factory;

use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Override;
use Throwable;

/**
 * @see LocalizedClockFactoryTest
 *
 * @implements FactoryInterface<LocalizedClock>
 */
final readonly class LocalizedClockFactory implements FactoryInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): LocalizedClock
    {
        return LocalizedClock::new();
    }
}
