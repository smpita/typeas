<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5\Resolved;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V5\V5TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\FloatableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicFloatableStub;
use Smpita\TypeAs\TypeAs;

class FloatTest extends V5TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_with_defaults(): void
    {
        $value = new \StdClass();
        $expected = 0.0;
        $options = ['default' => $expected];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_booleans(): void
    {
        $value1 = true;
        $expected1 = 1.0;
        $value2 = false;
        $expected2 = 0.0;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_floatable_objects(): void
    {
        $value = new FloatableStub($this->faker->randomFloat());
        $expected = $value->toFloat();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_backed_enums(): void
    {
        $value1 = IntBackedEnumStub::Zero;
        $expected1 = 0.0;
        $value2 = IntBackedEnumStub::One;
        $expected2 = 1.0;
        $value3 = StringBackedEnumStub::OnePointFive;
        $expected3 = 1.5;
        $value4 = StringBackedEnumStub::Two;
        $expected4 = 2.0;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
        $this->runAsserts($expected3, $value3);
        $this->runAsserts($expected4, $value4);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_magic_floatable_objects(): void
    {
        $value = new MagicFloatableStub($this->faker->randomFloat());
        $expected = $value->__toFloat();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_integers(): void
    {
        $value = 1234567890;
        $expected = 1234567890.0;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_floats(): void
    {
        $value = $this->faker->randomFloat();
        $expected = $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_open_resource(): void
    {
        $value = stream_context_create();
        $expected = (float) $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_fopen_resource(): void
    {
        $value = @fopen('php://memory', 'r');
        $expected = (float) $value;

        $this->runAsserts($expected, $value);
        fclose($value); // close the resource
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_strings(): void
    {
        $value = '0001234567890.000';
        $expected = 1234567890.0;

        $this->runAsserts($expected, $value);
    }

    private function runAsserts(float $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertSame($expected, TypeAs::float($value, ...$options), 'NonNullable static assertion failed');
        $this->assertSame($expected, \asFloat($value, ...$options), 'NonNullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asFloat($value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, false, $options)->asFloat(), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertSame($expected, TypeAs::nullableFloat($value, ...$options), 'Nullable static assertion failed');
        $this->assertSame($expected, \asNullableFloat($value, ...$options), 'Nullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asNullableFloat($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, true, $options)->asFloat(), 'Nullable fluent assertion failed');
    }
}
