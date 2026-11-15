<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

class FilterBoolExceptionTest extends V4TestCase
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
    public function test_will_throw_exception_on_unboolable_types(): void
    {
        $value = 'test';

        $this->runExceptionAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exceptions_on_non_truthy_floats(): void
    {
        $value1 = 1.1;
        $value2 = 0.1;

        $this->runExceptionAsserts($value1);
        $this->runExceptionAsserts($value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exceptions_on_non_truthy_ints(): void
    {
        $value1 = -1;
        $value2 = 2;

        $this->runExceptionAsserts($value1);
        $this->runExceptionAsserts($value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exceptions_on_resources(): void
    {
        $value = stream_context_create();

        $this->runExceptionAsserts($value);
    }

    private function runExceptionAsserts(mixed $value, array $options = []): void
    {
        $calls = [
            'NonNullable static' => fn () => TypeAs::filterBool($value, ...$options),
            'NonNullable helper' => fn () => \asFilterBool($value, ...$options),
            'NonNullable global helper' => fn () => \Smpita\TypeAs\asFilterBool($value, ...$options),
            'NonNullable fluent' => fn () => $this->builder($value, false, $options)->asFilterBool(),
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
