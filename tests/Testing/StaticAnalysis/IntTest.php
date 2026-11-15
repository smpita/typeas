<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class IntTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (int $value) => $value;
        $value = $this->faker->randomFloat();

        $this->assertIsInt($test(TypeAs::int($value)));
        $this->assertIsInt($test(\asInt($value)));
        $this->assertIsInt($test(\Smpita\TypeAs\asInt($value)));
        $this->assertIsInt($test(type($value)->asInt()));

        $this->assertIsInt($test(TypeAs::nullableInt($value)));
        $this->assertIsInt($test(\asNullableInt($value)));
        $this->assertIsInt($test(\Smpita\TypeAs\asNullableInt($value)));
        $this->assertIsInt($test(type($value)->nullable()->asInt()));
    }
}
