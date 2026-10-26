<?php

namespace Smpita\TypeAs\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class NullableArrayApiTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_they_handle_empty_array(): void
    {
        $value = [];
        $expected = [];

        $this->assertSame($expected, TypeAs::nullableArray($value));
        $this->assertSame($expected, type($value)->nullable()->asArray());
        $this->assertSame($expected, \asNullableArray($value));
        $this->assertSame($expected, \Smpita\TypeAs\asNullableArray($value));
    }
}
