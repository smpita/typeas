<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableFloatTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unfloatable_types(): void
    {
        $this->assertNull(TypeAs::nullableFloat([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unfloatable_objects(): void
    {
        $this->assertNull(TypeAs::nullableFloat(new \StdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_with_defaults(): void
    {
        $this->assertTrue(TypeAs::nullableFloat([], 0.0) === 0.0);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_strings(): void
    {
        $this->assertTrue(TypeAs::nullableFloat('0001234567890.000') === 1234567890.0);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_booleans(): void
    {
        $this->assertIsFloat(TypeAs::nullableFloat($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_floatable_objects(): void
    {
        $value = $this->faker->randomFloat();

        $this->assertEquals(TypeAs::nullableFloat(new NullableFloatableStub($value)), $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_magic_floatable_objects(): void
    {
        $value = $this->faker->randomFloat();

        $this->assertEquals(TypeAs::nullableFloat(new MagicNullableFloatableStub($value)), $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_open_resource(): void
    {
        $this->assertIsFloat(TypeAs::nullableFloat(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?float $value) => $value;

        $this->assertIsFloat($test(TypeAs::nullableFloat($this->faker->randomNumber())));
    }
}

class NullableFloatableStub
{
    public function __construct(public float $value)
    {
    }

    public function toFloat(): float
    {
        return $this->value;
    }
}

class MagicNullableFloatableStub
{
    public function __construct(public float $value)
    {
    }

    public function __toFloat(): float
    {
        return $this->value;
    }
}
