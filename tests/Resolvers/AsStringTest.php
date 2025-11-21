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
    public function test_will_return_null_on_unstringable_types(): void
    {
        $this->assertNull(TypeAs::nullableString([]));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_return_null_on_unstringable_objects(): void
    {
        $this->assertNull(TypeAs::nullableString(new \StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->assertTrue(TypeAs::nullableString(function () {}, 'default') === 'default');
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_stringify_integers(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->randomDigit()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_stringify_booleans(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_stringify_stringable_objects(): void
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
    public function test_can_stringify_magic_stringable_objects(): void
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
    public function test_can_stringify_open_resource(): void
    {
        $this->assertIsString(TypeAs::nullableString(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?string $value) => $value;

        $this->assertIsString($test(TypeAs::nullableString($this->faker->randomNumber())));
    }
}

class NullableStringableStub
{
    public function __construct(public string $value) {}

    public function toString(): string
    {
        return $this->value;
    }
}

class MagicNullableStringableStub
{
    public function __construct(public string $value) {}

    public function __toString(): string
    {
        return $this->value;
    }
}
