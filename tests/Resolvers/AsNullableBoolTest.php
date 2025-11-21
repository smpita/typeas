<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use UnexpectedValueException;

class AsNullableBoolTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_not_cast_null(): void
    {
        $this->assertNull(TypeAs::nullableBool(null));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_cast_null_with_defaults(): void
    {
        $this->assertTrue(TypeAs::nullableBool(null, true));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_strings(): void
    {
        $this->assertFalse(TypeAs::nullableBool('0'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_ints(): void
    {
        $this->assertFalse(TypeAs::nullableBool(0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_floats(): void
    {
        $this->assertFalse(TypeAs::nullableBool(0.0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::nullableBool($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_objects(): void
    {
        $this->assertTrue(TypeAs::nullableBool(new \stdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_resources(): void
    {
        $this->assertTrue(TypeAs::nullableBool(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?bool $value) => $value;

        $this->assertIsBool($test(TypeAs::nullableBool($this->faker->randomFloat())));
    }
}

class FakeNullableBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        throw new UnexpectedValueException();
    }
}
