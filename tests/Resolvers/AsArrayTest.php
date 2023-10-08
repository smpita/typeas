<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsArrayTest extends TestCase
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

        $this->assertSame($inner, TypeAs::array(new ArrayableStub($inner)));
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

        $this->assertSame($inner, TypeAs::array(new MagicArrayableStub($inner)));
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
        $this->assertSame([$string], TypeAs::array($string));
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
        $this->assertSame([$int], TypeAs::array($int));
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
        $this->assertSame([$float], TypeAs::array($float));
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
        $this->assertSame([$object], TypeAs::array($object));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionsIfNotWrapping(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::array($this->faker->sentence(), false);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionsIfNotReturningDefaults(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::array('', $array));
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

        $this->assertSame($array, TypeAs::array($array));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
    {
        $test = fn (array $value) => $value;

        $this->assertIsArray($test(TypeAs::array($this->faker->sentence())));
    }
}

class ArrayableStub
{
    public function __construct(public array $value)
    {
    }

    public function toArray(): array
    {
        return $this->value;
    }
}

class MagicArrayableStub
{
    public function __construct(public array $value)
    {
    }

    public function __toArray(): array
    {
        return $this->value;
    }
}
