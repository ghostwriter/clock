<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Clock\Container\ClockProvider;
use Ghostwriter\Container\Interface\BuilderInterface;
use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\ProviderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\InvocationMocker;
use PHPUnit\Framework\MockObject\InvocationStubber;
use Tests\Unit\AbstractTestCase;

use Throwable;

use function count;
use function is_a;

#[CoversClass(ClockProvider::class)]
final class ClockProviderTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testClockProviderBoot(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        /** @var null|InvocationMocker|InvocationStubber $last */
        $last = null;
        foreach ($this->getMethods(ContainerInterface::class) as $method) {
            $last = $container->expects(self::never())->method($method)->withAnyParameters();
        }
        $last?->seal();

        $provider = new ClockProvider();
        $provider->boot($container);
    }

    /** @throws Throwable */
    public function testClockProviderRegister(): void
    {
        $builder = $this->createMock(BuilderInterface::class);

        $arguments = [];

        foreach (ClockProvider::ALIAS as $alias => $service) {
            $arguments[] = [$alias, $service];
        }

        $builder->expects(self::exactly(count($arguments)))
            ->method('alias')
            ->withParameterSetsInOrder(...$arguments);

        $arguments = [];
        foreach (ClockProvider::FACTORY as $service => $factory) {
            $arguments[] = [$service, $factory];
        }

        $builder->expects(self::exactly(count($arguments)))
            ->method('factory')
            ->withParameterSetsInOrder(...$arguments);

        $last = null;
        foreach ($this->getMethods(BuilderInterface::class, ['alias', 'factory']) as $method) {
            $last = $builder->expects(self::never())->method($method)->withAnyParameters();
        }
        $last?->seal();

        $provider = new ClockProvider();
        $provider->register($builder);
    }

    /** @throws Throwable */
    public function testExtendsGhostwriterContainerServiceProviderAbstractProvider(): void
    {
        self::assertTrue(is_a(ClockProvider::class, AbstractProvider::class, true));
    }

    /** @throws Throwable */
    public function testImplementsGhostwriterContainerInterfaceServiceProviderInterface(): void
    {
        self::assertTrue(is_a(ClockProvider::class, ProviderInterface::class, true));
    }
}
