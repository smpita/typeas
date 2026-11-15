<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class FloatTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (float $value) => $value;
        $value = $this->faker->randomNumber();

        $this->assertIsFloat($test(TypeAs::float($value)));
        $this->assertIsFloat($test(\asFloat($value)));
        $this->assertIsFloat($test(\Smpita\TypeAs\asFloat($value)));
        $this->assertIsFloat($test(type($value)->asFloat()));

        $this->assertIsFloat($test(TypeAs::nullableFloat($value)));
        $this->assertIsFloat($test(\asNullableFloat($value)));
        $this->assertIsFloat($test(\Smpita\TypeAs\asNullableFloat($value)));
        $this->assertIsFloat($test(type($value)->nullable()->asFloat()));
    }
}
