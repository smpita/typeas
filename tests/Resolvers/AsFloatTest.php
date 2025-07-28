<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsFloatTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillThrowOnUnfloatableTypes(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::float([]);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillThrowOnUnfloatableObjects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::float(new \StdClass());
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotThrowWithDefaults(): void
    {
        $this->assertTrue(TypeAs::float([], 0.0) === 0.0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyStrings(): void
    {
        $this->assertTrue(TypeAs::float('0001234567890.000') === 1234567890.0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyBooleans(): void
    {
        $this->assertIsFloat(TypeAs::float($this->faker->boolean()));
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

        $this->assertEquals(TypeAs::float(new FloatableStub($value)), $value);
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

        $this->assertEquals(TypeAs::float(new MagicFloatableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanFloatifyOpenResource(): void
    {
        $this->assertIsFloat(TypeAs::float(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
    {
        $test = fn (float $value) => $value;

        $this->assertIsFloat($test(TypeAs::float($this->faker->randomNumber())));
    }
}

class FloatableStub
{
    public function __construct(public float $value)
    {
    }

    public function toFloat(): float
    {
        return $this->value;
    }
}

class MagicFloatableStub
{
    public function __construct(public float $value)
    {
    }

    public function __toFloat(): float
    {
        return $this->value;
    }
}
