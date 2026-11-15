<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Resolvers\V4\V4TestCase;
use Smpita\TypeAs\TypeAs;

class NullBoolTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_when_value_is_null(): void
    {
        $value = null;

        $this->runNullAsserts($value);
    }

    private function runNullAsserts(mixed $value, array $options = []): void
    {
        $this->assertNull(TypeAs::nullableBool($value, ...$options), 'Nullable static assertion failed');
        $this->assertNull(\asNullableBool($value, ...$options), 'Nullable helper assertion failed');
        $this->assertNull(\Smpita\TypeAs\asNullableBool($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertNull($this->builder($value, true, $options)->asBool(), 'Nullable fluent assertion failed');
    }
}
