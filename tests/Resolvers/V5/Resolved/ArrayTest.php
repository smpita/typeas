<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5\Resolved;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V5\V5TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ArrayableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\NotCallableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicArrayableStub;
use Smpita\TypeAs\TypeAs;

class ArrayTest extends V5TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_arrayable_objects(): void
    {
        $value = new ArrayableStub([$this->faker->sentence()]);
        $expected = $value->toArray();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_magic_arrayable_objects(): void
    {
        $value = new MagicArrayableStub([$this->faker->sentence()]);
        $expected = $value->__toArray();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_arrays(): void
    {
        $value = $this->faker->sentence();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_double_wrap_arrays(): void
    {
        $value = [$this->faker->sentence()];
        $expected = $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_bools(): void
    {
        $value = $this->faker->boolean();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_objects(): void
    {
        $value = new \StdClass();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_floats(): void
    {
        $value = $this->faker->randomFloat();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_integers(): void
    {
        $value = $this->faker->randomNumber();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_resources(): void
    {
        $value = stream_context_create();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_strings(): void
    {
        $value = $this->faker->sentence();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_int_backed_enums(): void
    {
        $value1 = IntBackedEnumStub::One;
        $value2 = IntBackedEnumStub::Zero;
        $expected1 = [IntBackedEnumStub::One];
        $expected2 = [IntBackedEnumStub::Zero];

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_string_backed_enums(): void
    {
        $value1 = StringBackedEnumStub::One;
        $value2 = StringBackedEnumStub::Two;
        $expected1 = [StringBackedEnumStub::One];
        $expected2 = [StringBackedEnumStub::Two];

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_arrayify_wraps_object_with_protected_magic_methods(): void
    {
        $value = new NotCallableStub();
        $expected = [$value];

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_arrayify_returns_arrayable_result_with_wrap_true(): void
    {
        $value = new ArrayableStub([$this->faker->sentence()]);
        $expected = $value->toArray();
        $options = ['wrap' => true];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_arrayify_returns_arrayable_result_with_wrap_false(): void
    {
        $value = new ArrayableStub([$this->faker->sentence()]);
        $expected = $value->toArray();
        $options = ['wrap' => false];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_defaults_when_has_default_and_not_wrapping(): void
    {
        $value = '';
        $expected = [$this->faker->sentence()];
        $options = ['default' => $expected, 'wrap' => false];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_wrap_scalars_when_passed_a_default(): void
    {
        $value = $this->faker->sentence();
        $expected = [$value];
        $options = ['default' => []];

        $this->runAsserts($expected, $value, $options);
    }

    private function runAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertSame($expected, TypeAs::array($value, ...$options), 'NonNullable static assertion failed');
        $this->assertSame($expected, \asArray($value, ...$options), 'NonNullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asArray($value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, false, $options)->asArray(), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertSame($expected, TypeAs::nullableArray($value, ...$options), 'Nullable static assertion failed');
        $this->assertSame($expected, \asNullableArray($value, ...$options), 'Nullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asNullableArray($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, true, $options)->asArray(), 'Nullable fluent assertion failed');
    }
}
