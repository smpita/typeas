<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class ArrayTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (array $value) => $value;
        $value = $this->faker->sentence();

        $this->assertIsArray($test(TypeAs::array($value)));
        $this->assertIsArray($test(\asArray($value)));
        $this->assertIsArray($test(\Smpita\TypeAs\asArray($value)));
        $this->assertIsArray($test(type($value)->asArray()));

        $this->assertIsArray($test(TypeAs::nullableArray($value)));
        $this->assertIsArray($test(\asNullableArray($value)));
        $this->assertIsArray($test(\Smpita\TypeAs\asNullableArray($value)));
        $this->assertIsArray($test(type($value)->nullable()->asArray()));
    }
}
