<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5\Resolved;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V5\V5TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\BoolableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicBoolableStub;
use Smpita\TypeAs\TypeAs;

class BoolTest extends V5TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_arrays(): void
    {
        $value1 = ['test'];
        $expected1 = true;
        $value2 = [];
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_booleans(): void
    {
        $value1 = true;
        $expected1 = true;
        $value2 = false;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_objects(): void
    {
        $value = new \stdClass();
        $expected = true;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_int_backed_enums(): void
    {
        $value1 = IntBackedEnumStub::One;
        $expected1 = true;
        $value2 = IntBackedEnumStub::Zero;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_string_backed_enums(): void
    {
        $value1 = StringBackedEnumStub::One;
        $expected1 = true;
        $value2 = StringBackedEnumStub::Zero;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_string_backed_enum_null_zero_empty_values(): void
    {
        $value1 = StringBackedEnumStub::Null;
        $expected1 = true;
        $value2 = StringBackedEnumStub::Zero;
        $expected2 = false;
        $value3 = StringBackedEnumStub::Empty;
        $expected3 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
        $this->runAsserts($expected3, $value3);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_boolable_objects(): void
    {
        $value1 = new BoolableStub(true);
        $expected1 = true;
        $value2 = new BoolableStub(false);
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_magic_boolable_objects(): void
    {
        $value1 = new MagicBoolableStub(true);
        $expected1 = true;
        $value2 = new MagicBoolableStub(false);
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_floats(): void
    {
        $value1 = 867.5309;
        $expected1 = true;
        $value2 = 0.0;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_ints(): void
    {
        $value1 = 12345;
        $expected1 = true;
        $value2 = 0;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_resources(): void
    {
        $value = stream_context_create();
        $expected = true;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_strings(): void
    {
        $value1 = 'test';
        $expected1 = true;
        $value2 = '0';
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    private function runAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertSame($expected, TypeAs::bool($value, ...$options), 'NonNullable static assertion failed');
        $this->assertSame($expected, \asBool($value, ...$options), 'NonNullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asBool($value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, false, $options)->asBool(), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertSame($expected, TypeAs::nullableBool($value, ...$options), 'Nullable static assertion failed');
        $this->assertSame($expected, \asNullableBool($value, ...$options), 'Nullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asNullableBool($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, true, $options)->asBool(), 'Nullable fluent assertion failed');
    }
}
