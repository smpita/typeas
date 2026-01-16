<?php

namespace Smpita\TypeAs\Tests\Resolvers\Extensions;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

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
    public function test_will_throw_exceptions_on_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        $this->assertTrue(TypeAs::filterBool(new FilterBoolStub()));
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
}

class FilterBoolStub
{
    public function __invoke(): bool
    {
        return true;
    }

    public function __toBool(): bool
    {
        return true;
    }

    public function toBool(): bool
    {
        return true;
    }
}
