<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableIntTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnUnintegerableTypes(): void
    {
        $this->assertNull(TypeAs::nullableInt([]));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnUnintegerableObjects(): void
    {
        $this->assertNull(TypeAs::nullableInt(new \StdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotThrowExceptionWithDefaults(): void
    {
        $this->assertTrue(TypeAs::nullableInt([], 0) === 0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanIntegerifyStrings(): void
    {
        $this->assertTrue(TypeAs::nullableInt('0001234567890.000') === 1234567890);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanIntegerifyBooleans(): void
    {
        $this->assertIsInt(TypeAs::nullableInt($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanIntegerifyIntegerableObjects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertEquals(TypeAs::nullableInt(new NullableIntegerableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanIntegerifyMagicIntegerableObjects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertEquals(TypeAs::nullableInt(new MagicNullableIntegerableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanInterifyOpenResource(): void
    {
        $this->assertIsInt(TypeAs::nullableInt(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
    {
        $test = fn (?int $value) => $value;

        $this->assertIsInt($test(TypeAs::nullableInt($this->faker->randomFloat())));
    }
}

class NullableIntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function toInteger(): int
    {
        return $this->value;
    }
}

class MagicNullableIntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function __toInteger(): int
    {
        return $this->value;
    }
}
