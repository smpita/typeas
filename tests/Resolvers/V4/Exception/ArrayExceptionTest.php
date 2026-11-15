<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Resolvers\V4\V4TestCase;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\TypeAs;

class ArrayExceptionTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_null_and_not_wrapping(): void
    {
        $value = null;
        $options = ['wrap' => false];

        $this->runExceptionAsserts($value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_when_no_default_and_not_wrapping(): void
    {
        $value = $this->faker->sentence();
        $options = ['wrap' => false];

        $this->runExceptionAsserts($value, $options);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_when_arrayifying_enums_and_not_wrapping(): void
    {
        $value = IntBackedEnumStub::One;
        $options = ['wrap' => false];

        $this->runExceptionAsserts($value, $options);
    }

    private function runExceptionAsserts(mixed $value, array $options = []): void
    {
        $calls = [
            'NonNullable static' => fn () => TypeAs::array($value, ...$options),
            'NonNullable helper' => fn () => \asArray($value, ...$options),
            'NonNullable global helper' => fn () => \Smpita\TypeAs\asArray($value, ...$options),
            'NonNullable fluent' => fn () => $this->builder($value, false, $options)->asArray(),
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
