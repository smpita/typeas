<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4\Resolved;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V4\V4TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicStringableStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\StringableStub;
use Smpita\TypeAs\TypeAs;

class StringTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $value = new \stdClass();
        $expected = $this->faker->word();
        $options = ['default' => $expected];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_booleans(): void
    {
        $value1 = true;
        $expected1 = '1';
        $value2 = false;
        $expected2 = '';

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_stringable_objects(): void
    {
        $value = new StringableStub($this->faker->word());
        $expected = $value->toString();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_floats(): void
    {
        $value = $this->faker->randomFloat();
        $expected = (string) $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_integers(): void
    {
        $value = $this->faker->randomNumber();
        $expected = (string) $value;

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_magic_stringable_objects(): void
    {
        $value = new MagicStringableStub($this->faker->word());
        $expected = $value->__toString();

        $this->runAsserts($expected, $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_open_resource(): void
    {
        $value = stream_context_create();
        $expected = (string) $value;

        $this->runAsserts($expected, $value);
    }

    private function runAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertSame($expected, TypeAs::string($value, ...$options), 'NonNullable static assertion failed');
        $this->assertSame($expected, \asString($value, ...$options), 'NonNullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asString($value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, false, $options)->asString(), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertSame($expected, TypeAs::nullableString($value, ...$options), 'Nullable static assertion failed');
        $this->assertSame($expected, \asNullableString($value, ...$options), 'Nullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asNullableString($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, true, $options)->asString(), 'Nullable fluent assertion failed');
    }

    // Requires V5

    // #[Test]
    // #[Group('smpita')]
    // #[Group('typeas')]
    // public function test_can_stringify_string_backed_enums(): void
    // {
    //     $value1 = StringBackedEnumStub::One;
    //     $expected1 = $value1->value;
    //     $value2 = StringBackedEnumStub::Two;
    //     $expected2 = $value2->value;

    //     $this->runAsserts($expected1, $value1);
    //     $this->runAsserts($expected2, $value2);
    // }

    // #[Test]
    // #[Group('smpita')]
    // #[Group('typeas')]
    // public function test_can_stringify_int_backed_enums(): void
    // {
    //     $value1 = IntBackedEnumStub::One;
    //     $expected1 = (string) $value1->value;
    //     $value2 = IntBackedEnumStub::Two;
    //     $expected2 = (string) $value2->value;

    //     $this->runAsserts($expected1, $value1);
    //     $this->runAsserts($expected2, $value2);
    // }
}
