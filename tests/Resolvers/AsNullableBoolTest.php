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
    public function willNotCastNull(): void
    {
        $this->assertNull(TypeAs::nullableBool(null));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willCastNullWithDefaults(): void
    {
        $this->assertTrue(TypeAs::nullableBool(null, true));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyStrings(): void
    {
        $this->assertFalse(TypeAs::nullableBool('0'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyInts(): void
    {
        $this->assertFalse(TypeAs::nullableBool(0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyFloats(): void
    {
        $this->assertFalse(TypeAs::nullableBool(0.0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyBooleans(): void
    {
        $this->assertIsBool(TypeAs::nullableBool($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyObjects(): void
    {
        $this->assertTrue(TypeAs::nullableBool(new \stdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyResources(): void
    {
        $this->assertTrue(TypeAs::nullableBool(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
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
