<?php

declare(strict_types=1);

namespace Ghostwriter\Clock\Container;

use Ghostwriter\Clock\Container\Factory\FrozenClockFactory;
use Ghostwriter\Clock\Container\Factory\LocalizedClockFactory;
use Ghostwriter\Clock\Container\Factory\SystemClockFactory;
use Ghostwriter\Clock\FrozenClock;
use Ghostwriter\Clock\Interface\ClockInterface;
use Ghostwriter\Clock\Interface\FrozenClockInterface;
use Ghostwriter\Clock\Interface\LocalizedClockInterface;
use Ghostwriter\Clock\Interface\SystemClockInterface;
use Ghostwriter\Clock\LocalizedClock;
use Ghostwriter\Clock\SystemClock;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;

/**
 * @see ClockProviderTest
 */
final class ClockProvider extends AbstractProvider
{
    /**
     * [alias => service].
     *
     * @var array<class-string,class-string>
     */
    public const array ALIAS = [
        ClockInterface::class => SystemClockInterface::class,
        FrozenClockInterface::class => FrozenClock::class,
        LocalizedClockInterface::class => LocalizedClock::class,
        SystemClockInterface::class => SystemClock::class,
        \Psr\Clock\ClockInterface::class =>  ClockInterface::class,
    ];

    /**
     * [service => factory].
     *
     * @var array<class-string,class-string<FactoryInterface>>
     */
    public const array FACTORY = [
        FrozenClock::class => FrozenClockFactory::class,
        LocalizedClock::class => LocalizedClockFactory::class,
        SystemClock::class => SystemClockFactory::class,
    ];
}
