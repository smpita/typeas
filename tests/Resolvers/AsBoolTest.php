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
    public function willThrowExceptionOnUnboolableTypes(): void
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
    public function willNotThrowExceptionWithDefaults(): void
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
    public function canBoolifyStrings(): void
    {
        $this->assertFalse(TypeAs::bool('0'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyInts(): void
    {
        $this->assertFalse(TypeAs::bool(0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyFloats(): void
    {
        $this->assertFalse(TypeAs::bool(0.0));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyBooleans(): void
    {
        $this->assertIsBool(TypeAs::bool($this->faker->boolean()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyObjects(): void
    {
        $this->assertTrue(TypeAs::bool(new \stdClass()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canBoolifyResources(): void
    {
        $this->assertTrue(TypeAs::bool(stream_context_create()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
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
