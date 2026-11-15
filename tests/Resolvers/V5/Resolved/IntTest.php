<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5\Resolved;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V5\V5TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\IntableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\IntegerableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicIntableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicIntegerableStub;
use Smpita\TypeAs\TypeAs;

class IntTest extends V5TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $value = [];
        $expected = $this->faker->randomNumber();
        $options = ['default' => $expected];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_booleans(): void
    {
        $value1 = true;
        $expected1 = 1;
        $value2 = false;
        $expected2 = 0;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integerable_objects(): void
    {
        $value = new IntegerableStub($this->faker->randomNumber());
        $expected = $value->toInteger();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_int_backed_enums(): void
    {
        $value1 = IntBackedEnumStub::One;
        $expected1 = $value1->value;
        $value2 = IntBackedEnumStub::Two;
        $expected2 = $value2->value;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_string_backed_enums(): void
    {
        $value1 = StringBackedEnumStub::One;
        $expected1 = (int) $value1->value;
        $value2 = StringBackedEnumStub::Two;
        $expected2 = (int) $value2->value;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_backed_enum_float_value(): void
    {
        // String '1.5' -> intval -> 1 (decimal truncated)
        $value = StringBackedEnumStub::OnePointFive;
        $expected = (int) $value->value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_magic_integerable_objects(): void
    {
        $value = new MagicIntegerableStub($this->faker->randomNumber());
        $expected = $value->__toInteger();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_magic_intable_objects(): void
    {
        $value = new MagicIntableStub($this->faker->randomNumber());
        $expected = $value->__toInt();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_intable_objects(): void
    {
        $value = new IntableStub($this->faker->randomNumber());
        $expected = $value->toInt();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integers(): void
    {
        $value = $this->faker->randomNumber();
        $expected = $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_floats(): void
    {
        $value = $this->faker->randomFloat();
        $expected = (int) $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_open_resource(): void
    {
        $value = stream_context_create();
        $expected = (int) $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_strings(): void
    {
        $value = '0001234567890.000';
        $expected = (int) $value;

        $this->runAsserts($expected, $value);
    }

    private function runAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertSame($expected, TypeAs::int($value, ...$options), 'NonNullable static assertion failed');
        $this->assertSame($expected, \asInt($value, ...$options), 'NonNullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asInt($value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, false, $options)->asInt(), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertSame($expected, TypeAs::nullableInt($value, ...$options), 'Nullable static assertion failed');
        $this->assertSame($expected, \asNullableInt($value, ...$options), 'Nullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asNullableInt($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, true, $options)->asInt(), 'Nullable fluent assertion failed');
    }
}
