<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4\Resolved;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V4\V4TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\TypeAs;
use StdClass;

class ClassTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_type_classes(): void
    {
        $value = new ParentClassStub();

        $this->runAsserts(ParentClassStub::class, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_infer_from_children_classes(): void
    {
        $value = new ChildClassStub();

        $this->runAsserts(ParentClassStub::class, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $value = new ParentClassStub();
        $default = new StdClass();

        $this->runAsserts(StdClass::class, $value, ['default' => $default]);
    }

    private function runAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertInstanceOf($expected, TypeAs::class($expected, $value, ...$options), 'NonNullable static assertion failed');
        $this->assertInstanceOf($expected, \asClass($expected, $value, ...$options), 'NonNullable helper assertion failed');
        $this->assertInstanceOf($expected, \Smpita\TypeAs\asClass($expected, $value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertInstanceOf($expected, $this->builder($value, false, $options)->asClass($expected), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertInstanceOf($expected, TypeAs::nullableClass($expected, $value, ...$options), 'Nullable static assertion failed');
        $this->assertInstanceOf($expected, \asNullableClass($expected, $value, ...$options), 'Nullable helper assertion failed');
        $this->assertInstanceOf($expected, \Smpita\TypeAs\asNullableClass($expected, $value, ...$options), 'Nullable global helper assertion failed');
        $this->assertInstanceOf($expected, $this->builder($value, true, $options)->asClass($expected), 'Nullable fluent assertion failed');
    }
}
