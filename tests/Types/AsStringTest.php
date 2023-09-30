<?php

namespace Smpita\TypeAs\Tests\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
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
    public function willThrowExceptionOnUnstringableTypes(): void
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
    public function willThrowExceptionOnUnstringableObjects(): void
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
    public function willNotThrowExceptionWithDefaults(): void
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
    public function canStringifyIntegers(): void
    {
        $this->assertIsString(TypeAs::string(fake()->randomDigit()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canStringifyBooleans(): void
    {
        $this->assertIsString(TypeAs::string(fake()->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canStringifyStringableObjects(): void
    {
        $value = fake()->word();

        $this->assertEquals(TypeAs::string(new StringableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canStringifyMagicStringableObjects(): void
    {
        $value = fake()->word();

        $this->assertEquals(TypeAs::string(new MagicStringableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canStringifyOpenResource(): void
    {
        $this->assertIsString(TypeAs::string(stream_context_create()));
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
