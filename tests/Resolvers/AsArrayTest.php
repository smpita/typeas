<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsArrayTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_arrayable_objects(): void
    {
        $inner = [$this->faker->sentence()];

        $this->assertSame($inner, TypeAs::array(new ArrayableStub($inner)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_magic_arrayable_objects(): void
    {
        $inner = [$this->faker->sentence()];

        $this->assertSame($inner, TypeAs::array(new MagicArrayableStub($inner)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_arrays(): void
    {
        $array = [$this->faker->sentence()];
        $this->assertSame($array, TypeAs::array($array));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_bools(): void
    {
        $bool = $this->faker->boolean();
        $this->assertSame([$bool], TypeAs::array($bool));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_objects(): void
    {
        $object = new \StdClass();
        $this->assertSame([$object], TypeAs::array($object));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_floats(): void
    {
        $float = $this->faker->randomFloat();
        $this->assertSame([$float], TypeAs::array($float));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_integers(): void
    {
        $int = $this->faker->randomNumber();
        $this->assertSame([$int], TypeAs::array($int));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_resources(): void
    {
        $resource = stream_context_create();
        $this->assertSame([$resource], TypeAs::array($resource));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_strings(): void
    {
        $string = $this->faker->sentence();
        $this->assertSame([$string], TypeAs::array($string));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_when_no_default_and_not_wrapping(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::array($this->faker->sentence(), wrap: false);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_defaults_when_has_default_and_not_wrapping(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::array('', $array, wrap: false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_wrap_scalars_when_passed_a_default(): void
    {
        $words = $this->faker->sentence();

        $this->assertSame([$words], TypeAs::array($words, []));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_double_wrap_arrays(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::array($array));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
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
