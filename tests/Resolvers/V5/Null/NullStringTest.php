<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\TypeAs;

class NullStringTest extends V5TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_when_value_is_null(): void
    {
        $value = null;

        $this->runNullAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unstringable_types(): void
    {
        $value = [];

        $this->runNullAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unstringable_objects(): void
    {
        $value = new \StdClass();

        $this->runNullAsserts($value);
    }

    private function runNullAsserts(mixed $value, array $options = []): void
    {
        $this->assertNull(TypeAs::nullableString($value, ...$options), 'Nullable static assertion failed');
        $this->assertNull(\asNullableString($value, ...$options), 'Nullable helper assertion failed');
        $this->assertNull(\Smpita\TypeAs\asNullableString($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertNull($this->builder($value, true, $options)->asString(), 'Nullable fluent assertion failed');
    }
}
