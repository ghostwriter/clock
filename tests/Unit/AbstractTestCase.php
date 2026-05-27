<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Throwable;

use function in_array;

abstract class AbstractTestCase extends TestCase
{
    /** @throws Throwable */
    public function getMethods(string $class, array $except = []): array
    {
        $reflectionClass = new ReflectionClass($class);

        $methods = [];
        foreach ($reflectionClass->getMethods() as $method) {
            $name = $method->getName();

            if (in_array($name, $except, true)) {
                continue;
            }

            $methods[] = $name;
        }

        return $methods;
    }
}
