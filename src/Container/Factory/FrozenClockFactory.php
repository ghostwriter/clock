<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Container\Factory;

use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Override;
use Throwable;

/**
 * @see FrozenClockFactoryTest
 *
 * @implements FactoryInterface<FrozenClock>
 */
final readonly class FrozenClockFactory implements FactoryInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): FrozenClock
    {
        return FrozenClock::new();
    }
}
