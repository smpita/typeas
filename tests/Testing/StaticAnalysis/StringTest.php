<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class StringTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?string $value) => $value;
        $value = $this->faker->randomNumber();

        $this->assertIsString($test(TypeAs::string($value)));
        $this->assertIsString($test(\asString($value)));
        $this->assertIsString($test(\Smpita\TypeAs\asString($value)));
        $this->assertIsString($test(type($value)->asString()));

        $this->assertIsString($test(TypeAs::nullableString($value)));
        $this->assertIsString($test(\asNullableString($value)));
        $this->assertIsString($test(\Smpita\TypeAs\asNullableString($value)));
        $this->assertIsString($test(type($value)->nullable()->asString()));
    }
}
