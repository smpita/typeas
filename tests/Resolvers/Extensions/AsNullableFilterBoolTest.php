<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Objects\FilterBoolStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicBoolableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicFilterBoolStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use stdClass;

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
    public function test_returns_null_on_non_boolable_types(): void
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
    public function test_can_boolify_backed_enums(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(IntBackedEnumStub::One));
        $this->assertTrue(TypeAs::nullableFilterBool(StringBackedEnumStub::One));
        $this->assertTrue(TypeAs::nullableFilterBool(StringBackedEnumStub::True));
        $this->assertTrue(TypeAs::nullableFilterBool(StringBackedEnumStub::Yes));
        $this->assertTrue(TypeAs::nullableFilterBool(StringBackedEnumStub::On));

        $this->assertFalse(TypeAs::nullableFilterBool(IntBackedEnumStub::Zero));
        $this->assertFalse(TypeAs::nullableFilterBool(StringBackedEnumStub::Zero));
        $this->assertFalse(TypeAs::nullableFilterBool(StringBackedEnumStub::False));
        $this->assertFalse(TypeAs::nullableFilterBool(StringBackedEnumStub::No));
        $this->assertFalse(TypeAs::nullableFilterBool(StringBackedEnumStub::Off));
        $this->assertFalse(TypeAs::nullableFilterBool(StringBackedEnumStub::Empty));

        $this->assertNull(TypeAs::nullableFilterBool(StringBackedEnumStub::Null));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_magic_boolable_objects(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(new MagicFilterBoolStub(true)));
        $this->assertFalse(TypeAs::nullableFilterBool(new MagicFilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_return_null_on_plain_objects(): void
    {

        $this->assertNull(TypeAs::nullableFilterBool(new stdClass()));
    }
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_return_null_when_boolable_objects_return_non_bools(): void
    {
        $object = new class () {
            public function __toBool(): int
            {
                return 1;
            }
        };

        $this->assertNull(TypeAs::nullableFilterBool($object));
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
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_filter_bool_with_filter_stub(): void
    {
        $this->assertTrue(TypeAs::filterBool(new FilterBoolStub(true)));
        $this->assertFalse(TypeAs::filterBool(new FilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_filter_bool_with_magic_stub(): void
    {
        $this->assertTrue(TypeAs::filterBool(new MagicFilterBoolStub(true)));
        $this->assertFalse(TypeAs::filterBool(new MagicFilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_filter_bool_with_magic_stub(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(new MagicFilterBoolStub(true)));
        $this->assertFalse(TypeAs::nullableFilterBool(new MagicFilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_filter_bool_with_filter_stub(): void
    {
        $this->assertTrue(TypeAs::nullableFilterBool(new FilterBoolStub(true)));
        $this->assertFalse(TypeAs::nullableFilterBool(new FilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_with_boolable_resolver_stub(): void
    {
        $this->assertTrue(TypeAs::nullableBool(new MagicBoolableStub(true)));
        $this->assertFalse(TypeAs::nullableBool(new MagicBoolableStub(false)));
    }
}
