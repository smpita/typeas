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
    public function test_will_return_null_on_unintegerable_types(): void
    {
        $this->assertNull(TypeAs::nullableInt([]));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_return_null_on_unintegerable_objects(): void
    {
        $this->assertNull(TypeAs::nullableInt(new \StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->assertTrue(TypeAs::nullableInt([], 0) === 0);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_integerify_strings(): void
    {
        $this->assertTrue(TypeAs::nullableInt('0001234567890.000') === 1234567890);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_integerify_booleans(): void
    {
        $this->assertIsInt(TypeAs::nullableInt($this->faker->boolean()));
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

        $this->assertEquals(TypeAs::nullableInt(new NullableIntegerableStub($value)), $value);
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

        $this->assertEquals(TypeAs::nullableInt(new MagicNullableIntegerableStub($value)), $value);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_interify_open_resource(): void
    {
        $this->assertIsInt(TypeAs::nullableInt(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?int $value) => $value;

        $this->assertIsInt($test(TypeAs::nullableInt($this->faker->randomFloat())));
    }
}

class NullableIntegerableStub
{
    public function __construct(public int $value) {}

    public function toInteger(): int
    {
        return $this->value;
    }
}

class MagicNullableIntegerableStub
{
    public function __construct(public int $value) {}

    public function __toInteger(): int
    {
        return $this->value;
    }
}
