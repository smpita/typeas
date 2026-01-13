<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsNullableBoolTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_cast_null(): void
    {
        $this->assertNull(TypeAs::nullableBool(null));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_cast_null_with_defaults(): void
    {
        $this->assertTrue(TypeAs::nullableBool(null, true));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_arrays(): void
    {
        $this->assertTrue(TypeAs::nullableBool(['test']));
        $this->assertFalse(TypeAs::nullableBool([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::nullableBool($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_floats(): void
    {
        $this->assertTrue(TypeAs::nullableBool(867.5309));
        $this->assertFalse(TypeAs::nullableBool(0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_ints(): void
    {
        $this->assertTrue(TypeAs::nullableBool(12345));
        $this->assertFalse(TypeAs::nullableBool(0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_objects(): void
    {
        $this->assertTrue(TypeAs::nullableBool(new \stdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_resources(): void
    {
        $this->assertTrue(TypeAs::nullableBool(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_strings(): void
    {
        // Non-truthy strings
        $this->assertTrue(TypeAs::nullableBool('test'));
        $this->assertTrue(TypeAs::nullableBool('null'));

        // Truthy strings
        $this->assertTrue(TypeAs::nullableBool('1'));
        $this->assertTrue(TypeAs::nullableBool('true'));
        $this->assertTrue(TypeAs::nullableBool('on'));
        $this->assertTrue(TypeAs::nullableBool('yes'));

        // Falsy strings
        $this->assertFalse(TypeAs::nullableBool('0'));
        $this->assertFalse(TypeAs::nullableBool('false'));
        $this->assertFalse(TypeAs::nullableBool('off'));
        $this->assertFalse(TypeAs::nullableBool('no'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?bool $value) => $value;

        $this->assertIsBool($test(TypeAs::nullableBool($this->faker->randomFloat())));
    }
}

class FakeNullableBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        throw new TypeAsResolutionException();
    }
}
