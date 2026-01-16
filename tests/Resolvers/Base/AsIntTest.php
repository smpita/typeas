<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsIntTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unintegerable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::int([]);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unintegerable_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::int(new \StdClass());
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
        $this->assertSame(1, TypeAs::int(true));
        $this->assertSame(0, TypeAs::int(false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integerable_objects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertSame($value, TypeAs::int(new IntegerableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_magic_integerable_objects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertSame($value, TypeAs::int(new MagicIntegerableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integers(): void
    {
        $int = $this->faker->randomNumber();

        $this->assertSame($int, TypeAs::int($int));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_floats(): void
    {
        $this->assertSame(867, TypeAs::int(867.5309));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_open_resource(): void
    {
        $this->assertIsInt(TypeAs::int(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_strings(): void
    {
        $this->assertSame(1234567890, TypeAs::int('0001234567890.000'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (int $value) => $value;

        $this->assertIsInt($test(TypeAs::int($this->faker->randomFloat())));
    }
}

class IntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function toInteger(): int
    {
        return $this->value;
    }
}

class MagicIntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function __toInteger(): int
    {
        return $this->value;
    }
}
