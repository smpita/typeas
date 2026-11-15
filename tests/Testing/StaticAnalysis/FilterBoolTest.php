<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class FilterBoolTest extends TestCase
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
    public function test_can_pass_static_analysis(mixed $truthy, bool $expected): void
    {
        $test = fn (bool $value) => $value;

        $this->assertSame($expected, $test(TypeAs::filterBool($truthy)));
        $this->assertSame($expected, $test(\asFilterBool($truthy)));
        $this->assertSame($expected, $test(\Smpita\TypeAs\asFilterBool($truthy)));
        $this->assertSame($expected, $test(type($truthy)->asFilterBool()));

        $this->assertSame($expected, $test(TypeAs::nullableFilterBool($truthy)));
        $this->assertSame($expected, $test(\asNullableFilterBool($truthy)));
        $this->assertSame($expected, $test(\Smpita\TypeAs\asNullableFilterBool($truthy)));
        $this->assertSame($expected, $test(type($truthy)->nullable()->asFilterBool()));
    }
}
