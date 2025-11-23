<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsStringTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unstringable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::string([]);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unstringable_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::string(new \StdClass());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $default = $this->faker->word();

        $this->assertSame($default, TypeAs::string(new \StdClass(), $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_booleans(): void
    {
        $this->assertSame('1', TypeAs::string(true));
        $this->assertSame('', TypeAs::string(false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_stringable_objects(): void
    {
        $value = $this->faker->word();

        $this->assertSame($value, TypeAs::string(new NullableStringableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_floats(): void
    {
        $this->assertIsString(TypeAs::string($this->faker->randomFloat()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_integers(): void
    {
        $this->assertIsString(TypeAs::string($this->faker->randomNumber()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_magic_stringable_objects(): void
    {
        $value = $this->faker->word();

        $this->assertSame($value, TypeAs::string(new MagicNullableStringableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_open_resource(): void
    {
        $this->assertIsString(TypeAs::string(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?string $value) => $value;

        $this->assertIsString($test(TypeAs::string($this->faker->randomNumber())));
    }
}

class NullableStringableStub
{
    public function __construct(public string $value)
    {
    }

    public function toString(): string
    {
        return $this->value;
    }
}

class MagicNullableStringableStub
{
    public function __construct(public string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
