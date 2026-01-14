<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableStringTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unstringable_types(): void
    {
        $this->assertNull(TypeAs::nullableString([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unstringable_objects(): void
    {
        $this->assertNull(TypeAs::nullableString(new \StdClass));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_return_null_with_defaults(): void
    {
        $default = $this->faker->word();

        $this->assertSame($default, TypeAs::nullableString(new \StdClass, $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_booleans(): void
    {
        $this->assertSame('1', TypeAs::nullableString(true));
        $this->assertSame('', TypeAs::nullableString(false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_floats(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->randomFloat()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_integers(): void
    {
        $this->assertIsString(TypeAs::nullableString($this->faker->randomNumber()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_stringable_objects(): void
    {
        $value = $this->faker->word();

        $this->assertSame(TypeAs::nullableString(new StringableStub($value)), $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_magic_stringable_objects(): void
    {
        $value = $this->faker->word();

        $this->assertSame(TypeAs::nullableString(new MagicStringableStub($value)), $value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_open_resource(): void
    {
        $this->assertIsString(TypeAs::nullableString(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_strings(): void
    {
        $string = $this->faker->word();

        $this->assertSame($string, TypeAs::nullableString($string));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?string $value) => $value;

        $this->assertIsString($test(TypeAs::nullableString($this->faker->randomNumber())));
    }
}

class StringableStub
{
    public function __construct(public string $value) {}

    public function toString(): string
    {
        return $this->value;
    }
}

class MagicStringableStub
{
    public function __construct(public string $value) {}

    public function __toString(): string
    {
        return $this->value;
    }
}
