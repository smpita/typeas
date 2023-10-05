<?php

namespace Smpita\TypeAs\Tests\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsIntegerTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionOnUnintegerableTypes(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::int([]);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionOnUnintegerableObjects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::int(new \StdClass());
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionWithDefaults(): void
    {
        $this->assertTrue(TypeAs::int([], 0) === 0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canIntegerifyStrings(): void
    {
        $this->assertTrue(TypeAs::int('0001234567890.000') === 1234567890);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canIntegerifyBooleans(): void
    {
        $this->assertIsInt(TypeAs::int($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canIntegerifyIntegerableObjects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertEquals(TypeAs::int(new IntegerableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canIntegerifyMagicIntegerableObjects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertEquals(TypeAs::int(new MagicIntegerableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canInterifyOpenResource(): void
    {
        $this->assertIsInt(TypeAs::int(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
    {
        $test = fn (int $value) => $value;

        $this->assertIsInt($test(TypeAs::int($this->faker->randomFloat())));
    }
}

class IntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function toInteger(): int
    {
        return $this->value;
    }
}

class MagicIntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function __toInteger(): int
    {
        return $this->value;
    }
}
