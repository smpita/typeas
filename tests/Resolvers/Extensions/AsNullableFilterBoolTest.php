<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsNullableFilterBoolTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unboolable_types(): void
    {
        $this->assertNull(TypeAs::nullableFilterBool($this->faker->word()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_return_null_with_defaults(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool($this->faker->word(), true));
        $this->assertFalse(TypeAs::nullableFilterBool($this->faker->word(), false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_defaults_when_null(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(null, true));
        $this->assertFalse(TypeAs::nullableFilterBool(null, false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_arrays(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(['test']));
        $this->assertFalse(TypeAs::nullableFilterBool([]));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::nullableFilterBool($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_floats(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(867.5309));
        $this->assertFalse(TypeAs::nullableFilterBool(0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_ints(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(12345));
        $this->assertFalse(TypeAs::nullableFilterBool(0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_objects(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(new \stdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_resources(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_strings(): void
    {
        // Truthy strings
        $this->assertTrue(TypeAs::nullableFilterBool('1'));
        $this->assertTrue(TypeAs::nullableFilterBool('true'));
        $this->assertTrue(TypeAs::nullableFilterBool('on'));
        $this->assertTrue(TypeAs::nullableFilterBool('yes'));

        // Falsy strings
        $this->assertFalse(TypeAs::nullableFilterBool(''));
        $this->assertFalse(TypeAs::nullableFilterBool('0'));
        $this->assertFalse(TypeAs::nullableFilterBool('false'));
        $this->assertFalse(TypeAs::nullableFilterBool('off'));
        $this->assertFalse(TypeAs::nullableFilterBool('no'));

        // Other strings return null
        $this->assertNull(TypeAs::nullableFilterBool('null'));
        $this->assertNull(TypeAs::nullableFilterBool($this->faker->word()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?bool $value) => $value;

        $this->assertIsBool($test(TypeAs::nullableFilterBool($this->faker->randomFloat())));
    }
}
