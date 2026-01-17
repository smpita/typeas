<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use PHPUnit\Framework\Attributes\DataProvider;
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

    public static function truthyDataProvider(): array
    {
        return [
            'truthy_1' => [1, true],
            'truthy_1_0' => [1.0, true],
            'truthy_1_string' => ['1', true],
            'truthy_string' => ['true', true],
            'truthy_yes' => ['yes', true],
            'truthy_on' => ['on', true],
            'falsy_0' => [0, false],
            'falsy_0_0' => [0.0, false],
            'falsy_0_string' => ['0', false],
            'falsy_string' => ['false', false],
            'falsy_no' => ['no', false],
            'falsy_off' => ['off', false],
            'falsy_empty' => ['', false],
            'nully_null' => ['null', null],
            'nully_any' => ['test', null],
        ];
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_boolify_strings(mixed $truthy, ?bool $expected): void
    {
        $this->assertSame($expected, TypeAs::nullableFilterBool($truthy));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_pass_static_analysis(mixed $truthy, ?bool $expected): void
    {
        $test = fn (?bool $value) => $value;

        $this->assertSame($expected, $test(TypeAs::nullableFilterBool($truthy)));
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
