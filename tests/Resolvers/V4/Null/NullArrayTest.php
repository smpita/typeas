<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V4\V4TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\TypeAs;

class NullArrayTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_when_value_is_null_and_wrap_is_false(): void
    {
        $value = null;
        $options = ['wrap' => false];

        $this->runNullAsserts($value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_when_no_default_and_not_wrapping(): void
    {
        $value = $this->faker->sentence();
        $options = ['wrap' => false];

        $this->runNullAsserts($value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_array_backed_enum_wrap_false_returns_null(): void
    {
        $value = IntBackedEnumStub::One;
        $options = ['wrap' => false];

        $this->runNullAsserts($value, $options);
    }

    private function runNullAsserts(mixed $value, array $options = []): void
    {
        $this->assertNull(TypeAs::nullableArray($value, ...$options), 'Nullable static assertion failed');
        $this->assertNull(\asNullableArray($value, ...$options), 'Nullable helper assertion failed');
        $this->assertNull(\Smpita\TypeAs\asNullableArray($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertNull($this->builder($value, true, $options)->asArray(), 'Nullable fluent assertion failed');
    }
}
