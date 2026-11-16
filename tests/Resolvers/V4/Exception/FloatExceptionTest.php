<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

class FloatExceptionTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_null(): void
    {
        $value = null;

        $this->runExceptionAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_on_unfloatable_types(): void
    {
        $value = [];

        $this->runExceptionAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_on_unfloatable_objects(): void
    {
        $value = new \stdClass();

        $this->runExceptionAsserts($value);
    }

    private function runExceptionAsserts(mixed $value, array $options = []): void
    {
        $calls = [
            'NonNullable static' => fn () => TypeAs::float($value, ...$options),
            'NonNullable helper' => fn () => \asFloat($value, ...$options),
            'NonNullable global helper' => fn () => \Smpita\TypeAs\asFloat($value, ...$options),
            'NonNullable fluent' => fn () => $this->builder($value, false, $options)->asFloat(),
        ];

        foreach ($calls as $name => $call) {
            try {
                $this->assertNull($call(), "{$name} assertion failed");
            } catch (TypeAsResolutionException) {
                $this->assertNull(null, "{$name} assertion passed");
            }
        }
    }
}
