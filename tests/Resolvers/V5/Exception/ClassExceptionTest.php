<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\TypeAs;

class ClassExceptionTest extends V5TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_null(): void
    {
        $value = null;

        $this->runExceptionAsserts(ParentClassStub::class, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_will_throw_exception_on_wrong_class(): void
    {
        $value = new ParentClassStub();

        $this->runExceptionAsserts(ChildClassStub::class, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_will_throw_exception_on_non_objects(): void
    {
        $value = ParentClassStub::class;

        $this->runExceptionAsserts(ParentClassStub::class, $value);
    }


    private function runExceptionAsserts(mixed $class, mixed $value, array $options = []): void
    {
        $calls = [
            'NonNullable static' => fn () => TypeAs::class($class, $value, ...$options),
            'NonNullable helper' => fn () => \asClass($class, $value, ...$options),
            'NonNullable global helper' => fn () => \Smpita\TypeAs\asClass($class, $value, ...$options),
            'NonNullable fluent' => fn () => $this->builder($value, false, $options)->asClass($class),
        ];

        foreach ($calls as $name => $call) {
            try {
                $this->assertNull($call(), "{$name} assertion failed");
            } catch (TypeAsResolutionException) {
                $this->assertNull(null, "{$name} assertion passed");
            }
        }
    }
}
