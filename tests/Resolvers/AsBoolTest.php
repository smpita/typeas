<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsBoolTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unboolable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::bool('', null, new FakeBoolResolverStub());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::bool('', true, new FakeBoolResolverStub());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_arrays(): void
    {
        $this->assertTrue(TypeAs::bool(['test']));
        $this->assertFalse(TypeAs::bool([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::bool($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_objects(): void
    {
        $this->assertTrue(TypeAs::bool(new \stdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_floats(): void
    {
        $this->assertTrue(TypeAs::bool(867.5309));
        $this->assertFalse(TypeAs::bool(0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_ints(): void
    {
        $this->assertTrue(TypeAs::bool(12345));
        $this->assertFalse(TypeAs::bool(0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_resources(): void
    {
        $this->assertTrue(TypeAs::bool(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_strings(): void
    {
        // Non-truthy strings
        $this->assertTrue(TypeAs::bool('test'));
        $this->assertTrue(TypeAs::bool('null'));
        $this->assertTrue(TypeAs::bool('NULL'));

        // Truthy strings
        $this->assertTrue(TypeAs::bool('1'));
        $this->assertTrue(TypeAs::bool('true'));
        $this->assertTrue(TypeAs::bool('on'));
        $this->assertTrue(TypeAs::bool('yes'));

        // Falsy strings
        $this->assertFalse(TypeAs::bool('0'));
        $this->assertFalse(TypeAs::bool('false'));
        $this->assertFalse(TypeAs::bool('off'));
        $this->assertFalse(TypeAs::bool('no'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (bool $value) => $value;

        $this->assertIsBool($test(TypeAs::bool($this->faker->randomFloat())));
    }
}

class FakeBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        throw new TypeAsResolutionException();
    }
}
