<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use UnexpectedValueException;

class AsBoolTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_throw_exception_on_unboolable_types(): void
    {
        $this->expectException(UnexpectedValueException::class);

        TypeAs::bool('', null, new FakeBoolResolverStub());
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->expectException(UnexpectedValueException::class);

        TypeAs::bool('', true, new FakeBoolResolverStub());
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_strings(): void
    {
        $this->assertFalse(TypeAs::bool('0'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_ints(): void
    {
        $this->assertFalse(TypeAs::bool(0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_floats(): void
    {
        $this->assertFalse(TypeAs::bool(0.0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::bool($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_objects(): void
    {
        $this->assertTrue(TypeAs::bool(new \stdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_boolify_resources(): void
    {
        $this->assertTrue(TypeAs::bool(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (bool $value) => $value;

        $this->assertIsBool($test(TypeAs::bool($this->faker->randomFloat())));
    }
}

class FakeBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        throw new UnexpectedValueException();
    }
}
