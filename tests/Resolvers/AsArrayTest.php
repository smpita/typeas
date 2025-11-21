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
    public function test_can_arrayify_arrayable_objects(): void
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
    public function test_can_arrayify_magic_arrayable_objects(): void
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
    public function test_can_arrayify_strings(): void
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
    public function test_can_arrayify_integers(): void
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
    public function test_can_arrayify_floats(): void
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
    public function test_can_arrayify_objects(): void
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
    public function test_will_throw_exceptions_if_not_wrapping(): void
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
    public function test_will_not_throw_exceptions_if_not_returning_defaults(): void
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
    public function test_will_not_double_wrap_arrays(): void
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
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (array $value) => $value;

        $this->assertIsArray($test(TypeAs::array($this->faker->sentence())));
    }
}

class ArrayableStub
{
    public function __construct(public array $value) {}

    public function toArray(): array
    {
        return $this->value;
    }
}

class MagicArrayableStub
{
    public function __construct(public array $value) {}

    public function __toArray(): array
    {
        return $this->value;
    }
}
