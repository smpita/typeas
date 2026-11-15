<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V4\V4TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\TypeAs;

class NullClassTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_when_value_is_null(): void
    {
        $value = null;

        $this->runNullAsserts(ParentClassStub::class, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_on_wrong_class(): void
    {
        $value = new ParentClassStub();

        $this->runNullAsserts(ChildClassStub::class, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_on_non_objects(): void
    {
        $value = ParentClassStub::class;

        $this->runNullAsserts(ParentClassStub::class, $value);
    }

    private function runNullAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        $this->assertNull(TypeAs::nullableClass($expected, $value, ...$options), 'Nullable static assertion failed');
        $this->assertNull(\asNullableClass($expected, $value, ...$options), 'Nullable helper assertion failed');
        $this->assertNull(\Smpita\TypeAs\asNullableClass($expected, $value, ...$options), 'Nullable global helper assertion failed');
        $this->assertNull($this->builder($value, true, $options)->asClass($expected), 'Nullable fluent assertion failed');
    }
}
