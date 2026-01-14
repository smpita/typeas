<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableIntTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unintegerable_types(): void
    {
        $this->assertNull(TypeAs::nullableInt([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unintegerable_objects(): void
    {
        $this->assertNull(TypeAs::nullableInt(new \StdClass));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $default = $this->faker->randomNumber();

        $this->assertSame($default, TypeAs::nullableInt([], $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_booleans(): void
    {
        $this->assertSame(1, TypeAs::nullableInt(true));
        $this->assertSame(0, TypeAs::nullableInt(false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integerable_objects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertSame($value, TypeAs::nullableInt(new NullableIntegerableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_magic_integerable_objects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertSame($value, TypeAs::nullableInt(new MagicNullableIntegerableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integers(): void
    {
        $int = $this->faker->randomNumber();

        $this->assertSame($int, TypeAs::nullableInt($int));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_floats(): void
    {
        $this->assertSame(867, TypeAs::nullableInt(867.5309));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_open_resource(): void
    {
        $this->assertIsInt(TypeAs::nullableInt(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_strings(): void
    {
        $this->assertSame(1234567890, TypeAs::nullableInt('0001234567890.000'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?int $value) => $value;

        $this->assertIsInt($test(TypeAs::nullableInt($this->faker->randomFloat())));
    }
}

class NullableIntegerableStub
{
    public function __construct(public int $value) {}

    public function toInteger(): int
    {
        return $this->value;
    }
}

class MagicNullableIntegerableStub
{
    public function __construct(public int $value) {}

    public function __toInteger(): int
    {
        return $this->value;
    }
}
