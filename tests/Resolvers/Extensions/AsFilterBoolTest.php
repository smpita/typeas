<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsFilterBoolTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exception_on_unboolable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::filterBool('test');
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->expectNotToPerformAssertions();

        TypeAs::filterBool('', true); // This should not throw an exception
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_return_defaults_when_null(): void
    {
        $this->assertTrue(TypeAs::filterBool(null, true));
        $this->assertFalse(TypeAs::filterBool(null, false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_arrays(): void
    {
        $this->assertTrue(TypeAs::filterBool(['test']));
        $this->assertFalse(TypeAs::filterBool([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::filterBool($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_objects(): void
    {
        $this->assertTrue(TypeAs::filterBool(new \stdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_floats(): void
    {
        $this->assertTrue(TypeAs::filterBool(867.5309));
        $this->assertFalse(TypeAs::filterBool(0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_ints(): void
    {
        $this->assertTrue(TypeAs::filterBool(12345));
        $this->assertFalse(TypeAs::filterBool(0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_resources(): void
    {
        $this->assertTrue(TypeAs::filterBool(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_strings(): void
    {
        // Truthy strings
        $this->assertTrue(TypeAs::filterBool('1'));
        $this->assertTrue(TypeAs::filterBool('true'));
        $this->assertTrue(TypeAs::filterBool('on'));
        $this->assertTrue(TypeAs::filterBool('yes'));

        // Falsy strings
        $this->assertFalse(TypeAs::filterBool('0'));
        $this->assertFalse(TypeAs::filterBool('false'));
        $this->assertFalse(TypeAs::filterBool('off'));
        $this->assertFalse(TypeAs::filterBool('no'));

        // Other strings will throw exceptions
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (bool $value) => $value;

        $this->assertIsBool($test(TypeAs::bool($this->faker->randomFloat())));
    }
}
