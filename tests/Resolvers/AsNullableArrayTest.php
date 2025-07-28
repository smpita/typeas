<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableArrayTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanArrayifyArrayableObjects(): void
    {
        $inner = [$this->faker->sentence()];

        $this->assertSame($inner, TypeAs::nullableArray(new NullableArrayableStub($inner)));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanArrayifyMagicArrayableObjects(): void
    {
        $inner = [$this->faker->sentence()];

        $this->assertSame($inner, TypeAs::nullableArray(new MagicNullableArrayableStub($inner)));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanArrayifyStrings(): void
    {
        $string = $this->faker->sentence();
        $this->assertSame([$string], TypeAs::nullableArray($string));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanArrayifyIntegers(): void
    {
        $int = $this->faker->randomNumber();
        $this->assertSame([$int], TypeAs::nullableArray($int));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanArrayifyFloats(): void
    {
        $float = $this->faker->randomFloat();
        $this->assertSame([$float], TypeAs::nullableArray($float));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanArrayifyObjects(): void
    {
        $object = new \StdClass;
        $this->assertSame([$object], TypeAs::nullableArray($object));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullIfNotWrapping(): void
    {
        $this->assertNull(TypeAs::nullableArray($this->faker->sentence(), false));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotReturnNullIfNotReturningDefaults(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::nullableArray('', $array));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotDoubleWrapArrays(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::nullableArray($array));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
    {
        $test = fn (?array $value) => $value;

        $this->assertIsArray($test(TypeAs::nullableArray($this->faker->sentence())));
    }
}

class NullableArrayableStub
{
    public function __construct(public array $value)
    {
    }

    public function toArray(): array
    {
        return $this->value;
    }
}

class MagicNullableArrayableStub
{
    public function __construct(public array $value)
    {
    }

    public function __toArray(): array
    {
        return $this->value;
    }
}
