<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableStringTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillThrowExceptionOnUnstringableTypes(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::string([]);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillThrowExceptionOnUnstringableObjects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::string(new \StdClass());
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotThrowExceptionWithDefaults(): void
    {
        $this->assertTrue(TypeAs::string(function () {
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
        $this->assertIsString(TypeAs::string($this->faker->randomDigit()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyBooleans(): void
    {
        $this->assertIsString(TypeAs::string($this->faker->boolean()));
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

        $this->assertEquals(TypeAs::string(new StringableStub($value)), $value);
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

        $this->assertEquals(TypeAs::string(new MagicStringableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanStringifyOpenResource(): void
    {
        $this->assertIsString(TypeAs::string(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
    {
        $test = fn (string $value) => $value;

        $this->assertIsString($test(TypeAs::string($this->faker->randomNumber())));
    }
}

class StringableStub
{
    public function __construct(public string $value)
    {
    }

    public function toString(): string
    {
        return $this->value;
    }
}

class MagicStringableStub
{
    public function __construct(public string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
