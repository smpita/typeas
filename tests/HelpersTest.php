<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use Smpita\TypeAs\TypeAs;
use stdClass;

class HelpersTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(\Smpita\TypeAs\asArray($mixed), TypeAs::array($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_bool_helper(): void
    {
        $mixed = $this->faker->randomElement([0, 1]);

        $this->assertSame(\Smpita\TypeAs\asBool($mixed), TypeAs::bool($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_class_helper(): void
    {
        $mixed = new HelperStub();

        $this->assertSame(\Smpita\TypeAs\asClass(stdClass::class, $mixed), TypeAs::class(stdClass::class, $mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(\Smpita\TypeAs\asFloat($mixed), TypeAs::float($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(\Smpita\TypeAs\asInt($mixed), TypeAs::int($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(\Smpita\TypeAs\asNullableArray($mixed), TypeAs::nullableArray($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_bool_helper(): void
    {
        $mixed = $this->faker->randomElement([0, 1]);

        $this->assertSame(\Smpita\TypeAs\asNullableBool($mixed), TypeAs::nullableBool($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_class_helper(): void
    {
        $mixed = new HelperStub();

        $this->assertSame(\Smpita\TypeAs\asNullableClass(stdClass::class, $mixed), TypeAs::nullableClass(stdClass::class, $mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(\Smpita\TypeAs\asNullableFloat($mixed), TypeAs::nullableFloat($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(\Smpita\TypeAs\asNullableInt($mixed), TypeAs::nullableInt($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(\Smpita\TypeAs\asNullableString($mixed), TypeAs::nullableString($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(\Smpita\TypeAs\asString($mixed), TypeAs::string($mixed));
    }
}

class HelperStub extends stdClass
{
}
