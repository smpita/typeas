<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\IntegerableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicIntegerableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsIntTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unintegerable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::int([]);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unintegerable_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::int(new \StdClass());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $default = $this->faker->randomNumber();

        $this->assertSame($default, TypeAs::nullableInt([], $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_booleans(): void
    {
        $this->assertSame(1, TypeAs::int(true));
        $this->assertSame(0, TypeAs::int(false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integerable_objects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertSame($value, TypeAs::int(new IntegerableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_magic_integerable_objects(): void
    {
        $value = $this->faker->randomNumber();

        $this->assertSame($value, TypeAs::int(new MagicIntegerableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_integers(): void
    {
        $int = $this->faker->randomNumber();

        $this->assertSame($int, TypeAs::int($int));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_floats(): void
    {
        $this->assertSame(867, TypeAs::int(867.5309));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_open_resource(): void
    {
        $this->assertIsInt(TypeAs::int(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_integerify_strings(): void
    {
        $this->assertSame(1234567890, TypeAs::int('0001234567890.000'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (int $value) => $value;

        $this->assertIsInt($test(TypeAs::int($this->faker->randomFloat())));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exception_with_message(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsInt ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat, $customException)
            ->int(null);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsInt]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::int(null);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exception_without_message(): void
    {
        $defaultMessage = 'Resolution error converting NULL [AsInt]';
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($defaultMessage);

        // throw a custom exception
        TypeAs::onError(exception: $customException)
            ->int(null);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_throw_message_without_exception(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsInt ' . $rng;
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat)
            ->int(null);
    }

}
