<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;

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
    public function test_return_null_on_arrays(): void
    {
        $this->assertNull(TypeAs::nullableFilterBool('test'));
        $this->assertNull(TypeAs::nullableFilterBool([]));
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
    #[Group('extensions')]
    public function test_will_return_null_on_objects(): void
    {
        $this->assertNull(TypeAs::nullableFilterBool(new NullableFilterBoolStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_floats(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(1.0));
        $this->assertFalse(TypeAs::nullableFilterBool(0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_return_null_on_non_truthy_floats(): void
    {
        $this->assertNull(TypeAs::nullableFilterBool(1.1));

        $this->assertNull(TypeAs::nullableFilterBool(0.1));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_ints(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(1));
        $this->assertFalse(TypeAs::nullableFilterBool(0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_resources(): void
    {
        $this->assertNull(TypeAs::nullableFilterBool(stream_context_create()));
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

        $truthies = [ 0, 1, 0.0, 1.0, '', '0', '1', 'on', 'off', 'yes', 'no', 'true', 'false' ];

        $this->assertIsBool($test(TypeAs::nullableFilterBool($this->faker->randomElement($truthies))));
    }
}
class NullableFilterBoolStub
{
    public function __invoke(): ?bool
    {
        return true;
    }

    public function __toBool(): ?bool
    {
        return true;
    }

    public function toBool(): ?bool
    {
        return true;
    }
}
