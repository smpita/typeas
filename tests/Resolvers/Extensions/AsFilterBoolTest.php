<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadCastableArrayStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadCastableFloatStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadCastableIntStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadCastableStringStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadMagicCastableArrayStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadMagicCastableFloatStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadMagicCastableIntStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\BadMagicCastableStringStub;
use Smpita\TypeAs\Tests\Stubs\Objects\FilterBoolStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicFilterBoolStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use stdClass;

class AsFilterBoolTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exception_on_unboolable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::filterBool('test');
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->expectNotToPerformAssertions();

        TypeAs::filterBool('test', true);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_return_defaults_when_null(): void
    {
        $this->assertTrue(TypeAs::filterBool(null, true));
        $this->assertFalse(TypeAs::filterBool(null, false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exception_on_arrays(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::filterBool([]);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_booleans(): void
    {
        $this->assertIsBool(TypeAs::filterBool($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_backed_enums(): void
    {
        $this->assertTrue(TypeAs::filterBool(IntBackedEnumStub::One));
        $this->assertTrue(TypeAs::filterBool(StringBackedEnumStub::One));
        $this->assertTrue(TypeAs::filterBool(StringBackedEnumStub::True));
        $this->assertTrue(TypeAs::filterBool(StringBackedEnumStub::Yes));
        $this->assertTrue(TypeAs::filterBool(StringBackedEnumStub::On));
        $this->assertFalse(TypeAs::filterBool(IntBackedEnumStub::Zero));
        $this->assertFalse(TypeAs::filterBool(StringBackedEnumStub::Zero));
        $this->assertFalse(TypeAs::filterBool(StringBackedEnumStub::False));
        $this->assertFalse(TypeAs::filterBool(StringBackedEnumStub::No));
        $this->assertFalse(TypeAs::filterBool(StringBackedEnumStub::Off));
        $this->assertFalse(TypeAs::filterBool(StringBackedEnumStub::Empty));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_magic_boolable_objects(): void
    {
        $this->assertTrue(TypeAs::filterBool(new MagicFilterBoolStub(true)));
        $this->assertFalse(TypeAs::filterBool(new MagicFilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_boolable_objects(): void
    {
        $this->assertTrue(TypeAs::filterBool(new FilterBoolStub(true)));
        $this->assertFalse(TypeAs::filterBool(new FilterBoolStub(false)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exceptions_on_plain_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::filterBool(new stdClass());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_use_defaults_when_boolable_objects_return_non_bools(): void
    {
        $default = false;

        $object = new class () {
            public function __toBool(): int
            {
                return 1;
            }
        };

        $this->assertSame($default, TypeAs::nullableFilterBool($object, $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_floats(): void
    {
        $this->assertTrue(TypeAs::filterBool(1.0));
        $this->assertFalse(TypeAs::filterBool(0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exceptions_on_non_truthy_floats(): void
    {
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool(1.1);

        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool(0.1);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_can_boolify_ints(): void
    {
        $this->assertTrue(TypeAs::filterBool(1));
        $this->assertFalse(TypeAs::filterBool(0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exceptions_on_non_truthy_ints(): void
    {
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool(2);

        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool(-1);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    public function test_will_throw_exceptions_on_resources(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::filterBool(stream_context_create());
    }

    public static function truthyDataProvider(): array
    {
        return [
            'truthy_1' => [1, true],
            'truthy_1_0' => [1.0, true],
            'truthy_1_string' => ['1', true],
            'truthy_string' => ['true', true],
            'truthy_yes' => ['yes', true],
            'truthy_on' => ['on', true],
            'falsy_0' => [0, false],
            'falsy_0_0' => [0.0, false],
            'falsy_0_string' => ['0', false],
            'falsy_string' => ['false', false],
            'falsy_no' => ['no', false],
            'falsy_off' => ['off', false],
            'falsy_empty' => ['', false],
        ];
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_boolify_strings(mixed $truthy, bool $expected): void
    {
        $this->assertSame($expected, TypeAs::filterBool($truthy));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    #[DataProvider('truthyDataProvider')]
    public function test_can_pass_static_analysis(mixed $truthy, bool $expected): void
    {
        $test = fn (bool $value) => $value;

        $this->assertSame($expected, $test(TypeAs::filterBool($truthy)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsFilterBool ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat, $customException)
            ->filterBool(null);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsFilterBool]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::filterBool(null);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsFilterBool]';
        $defaultException = TypeAsResolutionException::class;

        TypeAs::onError($customMessage, $customException)
            ->filterBool(false);

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::filterBool(null);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('extensions')]
    #[DataProvider('nonBoolToBoolStubs')]
    public function test_will_return_null_when__to_bool_returns_non_bool(mixed $object): void
    {
        $this->assertNull(TypeAs::nullableFilterBool($object));
    }

    /** @return array<string, array{mixed}> */
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
}
