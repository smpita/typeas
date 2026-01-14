<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
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

        $this->assertSame(TypeAs::array($mixed), \Smpita\TypeAs\asArray($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_bool_helper(): void
    {
        $mixed = $this->faker->randomElement([0, 1]);

        $this->assertSame(TypeAs::bool($mixed), \Smpita\TypeAs\asBool($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_class_helper(): void
    {
        $mixed = new HelperStub;

        $this->assertSame(TypeAs::class(stdClass::class, $mixed), \Smpita\TypeAs\asClass(stdClass::class, $mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(TypeAs::float($mixed), \Smpita\TypeAs\asFloat($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(TypeAs::int($mixed), \Smpita\TypeAs\asInt($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(TypeAs::nullableArray($mixed), \Smpita\TypeAs\asNullableArray($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_bool_helper(): void
    {
        $mixed = $this->faker->randomElement([0, 1]);

        $this->assertSame(TypeAs::nullableBool($mixed), \Smpita\TypeAs\asNullableBool($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_class_helper(): void
    {
        $mixed = new HelperStub;

        $this->assertSame(TypeAs::nullableClass(stdClass::class, $mixed), \Smpita\TypeAs\asNullableClass(stdClass::class, $mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(TypeAs::nullableFloat($mixed), \Smpita\TypeAs\asNullableFloat($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(TypeAs::nullableInt($mixed), \Smpita\TypeAs\asNullableInt($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_nullable_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(TypeAs::nullableString($mixed), \Smpita\TypeAs\asNullableString($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(TypeAs::string($mixed), \Smpita\TypeAs\asString($mixed));
    }
}

class HelperStub extends stdClass {}
