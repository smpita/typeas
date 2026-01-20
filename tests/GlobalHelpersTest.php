<?php

namespace Smpita\TypeAs\Tests;

use stdClass;
use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Fluent\NonNullable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\DataProvider;

class GlobalHelpersTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_type_helper(): void
    {
        $this->assertInstanceOf(NonNullable::class, \type(null));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(TypeAs::array($mixed), \asArray($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_nullable_array_helper(): void
    {
        $mixed = $this->faker->word();

        $this->assertSame(TypeAs::nullableArray($mixed), \asNullableArray($mixed));
    }

    public static function truthyDataProvider(): array
    {
        return [
            'truthy_1' => [1],
            'truthy_1_0' => [1.0],
            'truthy_1_string' => ['1'],
            'truthy_string' => ['true'],
            'truthy_yes' => ['yes'],
            'truthy_on' => ['on'],
            'falsy_0' => [0],
            'falsy_0_0' => [0.0],
            'falsy_0_string' => ['0'],
            'falsy_string' => ['false'],
            'falsy_no' => ['no'],
            'falsy_off' => ['off'],
            'falsy_empty' => [''],
        ];
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_use_global_bool_helper(mixed $truthy): void
    {
        $this->assertSame(TypeAs::bool($truthy), \asBool($truthy));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_use_global_nullable_bool_helper(mixed $truthy): void
    {
        $this->assertSame(TypeAs::nullableBool($truthy), \asNullableBool($truthy));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_use_global_filter_bool_helper(mixed $truthy): void
    {
        $this->assertSame(TypeAs::filterBool($truthy), \asFilterBool($truthy));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_use_global_nullable_filter_bool_helper(mixed $truthy): void
    {
        $this->assertSame(TypeAs::nullableFilterBool($truthy), \asNullableFilterBool($truthy));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_class_helper(): void
    {
        $mixed = new HelperStub();

        $this->assertSame(TypeAs::class(stdClass::class, $mixed), \asClass(stdClass::class, $mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_nullable_class_helper(): void
    {
        $mixed = new HelperStub();

        $this->assertSame(TypeAs::nullableClass(stdClass::class, $mixed), \asNullableClass(stdClass::class, $mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(TypeAs::float($mixed), \asFloat($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_nullable_float_helper(): void
    {
        $mixed = strval($this->faker->randomFloat());

        $this->assertSame(TypeAs::nullableFloat($mixed), \asNullableFloat($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(TypeAs::int($mixed), \asInt($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_nullable_int_helper(): void
    {
        $mixed = strval($this->faker->randomNumber());

        $this->assertSame(TypeAs::nullableInt($mixed), \asNullableInt($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_nullable_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(TypeAs::nullableString($mixed), \asNullableString($mixed));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_global_string_helper(): void
    {
        $mixed = $this->faker->randomNumber();

        $this->assertSame(TypeAs::string($mixed), \asString($mixed));
    }
}

class GlobalHelperStub extends stdClass
{
}
