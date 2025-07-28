<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsStringTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnUnstringableTypes(): void
    {
        $this->assertNull(TypeAs::nullableString([]));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnUnstringableObjects(): void
    {
        $this->assertNull(TypeAs::nullableString(new \StdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotThrowExceptionWithDefaults(): void
    {
        $this->assertTrue(TypeAs::nullableString(function () {
        }, 'default') === 'default');
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyIntegers(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->randomDigit()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyBooleans(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyStringableObjects(): void
    {
        $value = $this->faker->word();

        $this->assertEquals(TypeAs::nullableString(new NullableStringableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyMagicStringableObjects(): void
    {
        $value = $this->faker->word();

        $this->assertEquals(TypeAs::nullableString(new MagicNullableStringableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyOpenResource(): void
    {
        $this->assertIsString(TypeAs::nullableString(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
    {
        $test = fn (?string $value) => $value;

        $this->assertIsString($test(TypeAs::nullableString($this->faker->randomNumber())));
    }
}

class NullableStringableStub
{
    public function __construct(public string $value)
    {
    }

    public function toString(): string
    {
        return $this->value;
    }
}

class MagicNullableStringableStub
{
    public function __construct(public string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
