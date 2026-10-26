<?php

namespace Smpita\TypeAs\Tests\Api;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class ArrayApiTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_they_handle_empty_array(): void
    {
        $value = [];
        $expected = [];

        $this->assertSame($expected, TypeAs::array($value));
        $this->assertSame($expected, type($value)->asArray());
        $this->assertSame($expected, \asArray($value));
        $this->assertSame($expected, \Smpita\TypeAs\asArray($value));
    }
}
