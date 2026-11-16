<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class BoolTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (bool $value) => $value;
        $value = $this->faker->randomFloat();

        $this->assertIsBool($test(TypeAs::bool($value)));
        $this->assertIsBool($test(\asBool($value)));
        $this->assertIsBool($test(\Smpita\TypeAs\asBool($value)));
        $this->assertIsBool($test(type($value)->asBool()));

        $this->assertIsBool($test(TypeAs::nullableBool($value)));
        $this->assertIsBool($test(\asNullableBool($value)));
        $this->assertIsBool($test(\Smpita\TypeAs\asNullableBool($value)));
        $this->assertIsBool($test(type($value)->nullable()->asBool()));
    }
}
