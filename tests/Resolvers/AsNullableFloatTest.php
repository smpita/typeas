<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableFloatTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnUnfloatableTypes(): void
    {
        $this->assertNull(TypeAs::nullableFloat([]));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnUnfloatableObjects(): void
    {
        $this->assertNull(TypeAs::nullableFloat(new \StdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotThrowWithDefaults(): void
    {
        $this->assertTrue(TypeAs::nullableFloat([], 0.0) === 0.0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyStrings(): void
    {
        $this->assertTrue(TypeAs::nullableFloat('0001234567890.000') === 1234567890.0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyBooleans(): void
    {
        $this->assertIsFloat(TypeAs::nullableFloat($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyFloatableObjects(): void
    {
        $value = $this->faker->randomFloat();

        $this->assertEquals(TypeAs::nullableFloat(new NullableFloatableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyMagicFloatableObjects(): void
    {
        $value = $this->faker->randomFloat();

        $this->assertEquals(TypeAs::nullableFloat(new MagicNullableFloatableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyOpenResource(): void
    {
        $this->assertIsFloat(TypeAs::nullableFloat(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
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
