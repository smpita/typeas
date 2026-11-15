<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Testing\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadCastableArrayStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadCastableFloatStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadCastableIntStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadCastableStringStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadMagicCastableArrayStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadMagicCastableFloatStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadMagicCastableIntStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases\BadMagicCastableStringStub;
use Smpita\TypeAs\TypeAs;

class NullFilterBoolTest extends V4TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_will_return_null_when_value_is_null(): void
    {
        $value = null;

        $this->runNullAsserts($value);
    }

    /**
     * @return array<string, array{mixed}>
     */
    public static function nonBoolToBoolStubs(): array
    {
        return [
            '__array' => [new BadCastableArrayStub([1, 2, 3])],
            '__int' => [new BadCastableIntStub(1)],
            '__float' => [new BadCastableFloatStub(1.0)],
            '__string' => [new BadCastableStringStub('yes')],
            'array' => [new BadMagicCastableArrayStub([1, 2, 3])],
            'int' => [new BadMagicCastableIntStub(1)],
            'float' => [new BadMagicCastableFloatStub(1.0)],
            'string' => [new BadMagicCastableStringStub('yes')],
        ];
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('nonBoolToBoolStubs')]
    public function test_will_return_null_when__to_bool_returns_non_bool(mixed $value): void
    {
        $this->runNullAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_unfilterboolable_types(): void
    {
        $value = $this->faker->word();

        $this->runNullAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_return_null_on_backed_enum_with_null_string(): void
    {
        $value = StringBackedEnumStub::Null;

        $this->runNullAsserts($value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_non_truthy_floats(): void
    {
        $value1 = 0.1;
        $value2 = 1.1;

        $this->runNullAsserts($value1);
        $this->runNullAsserts($value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_returns_null_on_non_filterboolable_types(): void
    {
        $value1 = 'null';
        $value2 = [];

        $this->runNullAsserts($value1);
        $this->runNullAsserts($value2);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_resources(): void
    {
        $value = stream_context_create();

        $this->runNullAsserts($value);
    }

    private function runNullAsserts(mixed $value, array $options = []): void
    {
        $this->assertNull(TypeAs::nullableFilterBool($value, ...$options), 'Nullable static assertion failed');
        $this->assertNull(\asNullableFilterBool($value, ...$options), 'Nullable helper assertion failed');
        $this->assertNull(\Smpita\TypeAs\asNullableFilterBool($value, ...$options), 'Nullable global helper assertion failed');
        $this->assertNull($this->builder($value, true, $options)->asFilterBool(), 'Nullable fluent assertion failed');
    }
}
