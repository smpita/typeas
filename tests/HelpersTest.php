<?php

namespace Smpita\TypeAs\Tests;

use Smpita\TypeAs\TypeAs;
use stdClass;

class HelpersTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(\Smpita\TypeAs\asArray($mixed), TypeAs::array($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_class_helper(): void
    {
        $mixed = new HelperStub();

        $this->assertSame(\Smpita\TypeAs\asClass(stdClass::class, $mixed), TypeAs::class(stdClass::class, $mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(\Smpita\TypeAs\asFloat($mixed), TypeAs::float($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(\Smpita\TypeAs\asInt($mixed), TypeAs::int($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_nullable_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(\Smpita\TypeAs\asNullableArray($mixed), TypeAs::nullableArray($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_nullable_class_helper(): void
    {
        $mixed = new HelperStub();

        $this->assertSame(\Smpita\TypeAs\asNullableClass(stdClass::class, $mixed), TypeAs::nullableClass(stdClass::class, $mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_nullable_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(\Smpita\TypeAs\asNullableFloat($mixed), TypeAs::nullableFloat($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_nullable_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(\Smpita\TypeAs\asNullableInt($mixed), TypeAs::nullableInt($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_nullable_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(\Smpita\TypeAs\asNullableString($mixed), TypeAs::nullableString($mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_use_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(\Smpita\TypeAs\asString($mixed), TypeAs::string($mixed));
    }
}

class HelperStub extends stdClass
{
}
