<?php

namespace Smpita\TypeAs\Tests\Types;

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
        $inner = [fake()->sentence];

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
        $inner = [fake()->sentence];

        $this->assertSame($inner, TypeAs::array(new MagicArrayableStub($inner)));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canArrayifyEverything(): void
    {
        $string = fake()->sentence();
        $this->assertSame([$string], TypeAs::array($string));

        $int = fake()->randomNumber();
        $this->assertSame([$int], TypeAs::array($int));

        $float = fake()->randomFloat();
        $this->assertSame([$float], TypeAs::array($float));

        $object = new \StdClass;
        $this->assertSame([$object], TypeAs::array($object));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotDoubleWrapArrays(): void
    {
        $array = [fake()->sentence];

        $this->assertSame($array, TypeAs::array($array));
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
