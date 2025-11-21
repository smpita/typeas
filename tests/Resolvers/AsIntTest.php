<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsIntTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_throw_exception_on_unintegerable_types(): void
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
    public function test_will_throw_exception_on_unintegerable_objects(): void
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
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->assertTrue(TypeAs::int([], 0) === 0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_integerify_strings(): void
    {
        $this->assertTrue(TypeAs::int('0001234567890.000') === 1234567890);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_integerify_booleans(): void
    {
        $this->assertIsInt(TypeAs::int($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_integerify_integerable_objects(): void
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
    public function test_can_integerify_magic_integerable_objects(): void
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
    public function test_can_interify_open_resource(): void
    {
        $this->assertIsInt(TypeAs::int(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
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
