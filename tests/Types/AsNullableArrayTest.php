<?php

namespace Smpita\TypeAs\Tests\Types;

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
    public function canArrayifyArrayableObjects(): void
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
    public function canArrayifyMagicArrayableObjects(): void
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
    public function canArrayifyStrings(): void
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
    public function canArrayifyIntegers(): void
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
    public function canArrayifyFloats(): void
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
    public function canArrayifyObjects(): void
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
    public function willReturnNullIfNotWrapping(): void
    {
        $this->assertNull(TypeAs::nullableArray($this->faker->sentence(), false));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotReturnNullIfNotReturningDefaults(): void
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
    public function willNotDoubleWrapArrays(): void
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
    public function canPassStaticAnalysis(): void
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
