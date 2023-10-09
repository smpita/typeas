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
    public function canUseArrayHelper(): void
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
    public function canUseClassHelper(): void
    {
        $mixed = new HelperStub;

        $this->assertSame(\Smpita\TypeAs\asClass(stdClass::class, $mixed), TypeAs::class(stdClass::class, $mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canUseFloatHelper(): void
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
    public function canUseIntHelper(): void
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
    public function canUseNullableArrayHelper(): void
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
    public function canUseNullableClassHelper(): void
    {
        $mixed = new HelperStub;

        $this->assertSame(\Smpita\TypeAs\asNullableClass(stdClass::class, $mixed), TypeAs::nullableClass(stdClass::class, $mixed));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canUseNullableFloatHelper(): void
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
    public function canUseNullableIntHelper(): void
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
    public function canUseNullableStringHelper(): void
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
    public function canUseStringHelper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(\Smpita\TypeAs\asString($mixed), TypeAs::string($mixed));
    }
}

class HelperStub extends stdClass
{
}
