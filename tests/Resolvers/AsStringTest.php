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
    public function willReturnNullOnUnstringableTypes(): void
    {
        $this->assertNull(TypeAs::nullableString([]));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willReturnNullOnUnstringableObjects(): void
    {
        $this->assertNull(TypeAs::nullableString(new \StdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionWithDefaults(): void
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
    public function canStringifyIntegers(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->randomDigit()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canStringifyBooleans(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canStringifyStringableObjects(): void
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
    public function canStringifyMagicStringableObjects(): void
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
    public function canStringifyOpenResource(): void
    {
        $this->assertIsString(TypeAs::nullableString(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
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
