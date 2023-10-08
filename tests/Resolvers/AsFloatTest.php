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
    public function willThrowOnUnfloatableTypes(): void
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
    public function willThrowOnUnfloatableObjects(): void
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
    public function willNotThrowWithDefaults(): void
    {
        $this->assertTrue(TypeAs::float([], 0.0) === 0.0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canFloatifyStrings(): void
    {
        $this->assertTrue(TypeAs::float('0001234567890.000') === 1234567890.0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canFloatifyBooleans(): void
    {
        $this->assertIsFloat(TypeAs::float($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canFloatifyFloatableObjects(): void
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
    public function canFloatifyMagicFloatableObjects(): void
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
    public function canFloatifyOpenResource(): void
    {
        $this->assertIsFloat(TypeAs::float(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
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
