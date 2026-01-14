<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableArrayTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_arrays(): void
    {
        $array = [$this->faker->sentence()];
        $this->assertSame($array, TypeAs::nullableArray($array));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_bools(): void
    {
        $bool = $this->faker->boolean();
        $this->assertSame([$bool], TypeAs::nullableArray($bool));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_objects(): void
    {
        $object = new \StdClass;
        $this->assertSame([$object], TypeAs::nullableArray($object));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_arrayable_objects(): void
    {
        $inner = [$this->faker->sentence()];

        $this->assertSame($inner, TypeAs::nullableArray(new NullableArrayableStub($inner)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_magic_arrayable_objects(): void
    {
        $inner = [$this->faker->sentence()];

        $this->assertSame($inner, TypeAs::nullableArray(new MagicNullableArrayableStub($inner)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_integers(): void
    {
        $int = $this->faker->randomNumber();
        $this->assertSame([$int], TypeAs::nullableArray($int));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_floats(): void
    {
        $float = $this->faker->randomFloat();
        $this->assertSame([$float], TypeAs::nullableArray($float));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_resources(): void
    {
        $resource = stream_context_create();
        $this->assertSame([$resource], TypeAs::nullableArray($resource));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_arrayify_strings(): void
    {
        $string = $this->faker->sentence();
        $this->assertSame([$string], TypeAs::nullableArray($string));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_when_no_default_and_not_wrapping(): void
    {
        $this->assertNull(TypeAs::nullableArray($this->faker->sentence(), wrap: false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_defaults_when_has_default_and_not_wrapping(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::nullableArray('', $array, wrap: false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_wrap_scalars_when_passed_a_default(): void
    {
        $words = $this->faker->sentence();

        $this->assertSame([$words], TypeAs::nullableArray($words, []));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_double_wrap_arrays(): void
    {
        $array = [$this->faker->sentence()];

        $this->assertSame($array, TypeAs::nullableArray($array));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?array $value) => $value;

        $this->assertIsArray($test(TypeAs::nullableArray($this->faker->sentence())));
    }
}

class NullableArrayableStub
{
    public function __construct(public array $value) {}

    public function toArray(): array
    {
        return $this->value;
    }
}

class MagicNullableArrayableStub
{
    public function __construct(public array $value) {}

    public function __toArray(): array
    {
        return $this->value;
    }
}
