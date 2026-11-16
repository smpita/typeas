<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5\Resolved;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V5\V5TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\FilterBoolStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MagicFilterBoolStub;
use Smpita\TypeAs\TypeAs;

class FilterBoolTest extends V5TestCase
{
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
        ];
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_boolify_truthies(mixed $truthy, bool $expected): void
    {
        $this->runAsserts($expected, $truthy);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $value = 'test';
        $expected = true;
        $options = ['default' => $expected];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_defaults_when_null(): void
    {
        $value = null;
        $expected = true;
        $options = ['default' => $expected];

        $this->runAsserts($expected, $value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_booleans(): void
    {
        $value1 = true;
        $expected1 = $value1;
        $value2 = false;
        $expected2 = $value2;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_backed_enums(): void
    {
        $this->runAsserts(true, IntBackedEnumStub::One);
        $this->runAsserts(true, StringBackedEnumStub::One);
        $this->runAsserts(true, StringBackedEnumStub::True);
        $this->runAsserts(true, StringBackedEnumStub::Yes);
        $this->runAsserts(true, StringBackedEnumStub::On);
        $this->runAsserts(false, IntBackedEnumStub::Zero);
        $this->runAsserts(false, StringBackedEnumStub::Zero);
        $this->runAsserts(false, StringBackedEnumStub::False);
        $this->runAsserts(false, StringBackedEnumStub::No);
        $this->runAsserts(false, StringBackedEnumStub::Off);
        $this->runAsserts(false, StringBackedEnumStub::Empty);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_magic_boolable_objects(): void
    {
        $value1 = new MagicFilterBoolStub(true);
        $expected1 = $value1->__toBool();
        $value2 = new MagicFilterBoolStub(false);
        $expected2 = $value2->__toBool();

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_boolable_objects(): void
    {
        $value1 = new FilterBoolStub(true);
        $expected1 = $value1->toBool();
        $value2 = new FilterBoolStub(false);
        $expected2 = $value2->toBool();

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_floats(): void
    {
        $value1 = 1.0;
        $expected1 = true;
        $value2 = 0.0;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_boolify_ints(): void
    {
        $value1 = 1;
        $expected1 = true;
        $value2 = 0;
        $expected2 = false;

        $this->runAsserts($expected1, $value1);
        $this->runAsserts($expected2, $value2);
    }

    private function runAsserts(mixed $expected, mixed $value, array $options = []): void
    {
        // NonNullable
        $this->assertSame($expected, TypeAs::filterBool($value, ...$options), 'NonNullable static assertion failed');
        $this->assertSame($expected, \asFilterBool($value, ...$options), 'NonNullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asFilterBool($value, ...$options), 'NonNullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, false, $options)->asFilterBool(), 'NonNullable fluent assertion failed');

        // Nullable
        $this->assertSame($expected, TypeAs::nullableFilterBool($value, ...$options), 'Nullable static assertion failed');
        $this->assertSame($expected, \asNullableFilterBool($value, ...$options), 'Nullable helper assertion failed');
        $this->assertSame($expected, \Smpita\TypeAs\asNullableFilterBool($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertSame($expected, $this->builder($value, true, $options)->asFilterBool(), 'Nullable fluent assertion failed');
    }
}
