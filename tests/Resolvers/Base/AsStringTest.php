<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicStringableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\StringableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsStringTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unstringable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::string([]);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_unstringable_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::string(new \StdClass());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $default = $this->faker->word();

        $this->assertSame($default, TypeAs::string(new \StdClass(), $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_booleans(): void
    {
        $this->assertSame('1', TypeAs::string(true));
        $this->assertSame('', TypeAs::string(false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_stringable_objects(): void
    {
        $value = $this->faker->word();

        $this->assertSame($value, TypeAs::string(new StringableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_floats(): void
    {
        $this->assertIsString(TypeAs::string($this->faker->randomFloat()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_integers(): void
    {
        $this->assertIsString(TypeAs::string($this->faker->randomNumber()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_magic_stringable_objects(): void
    {
        $value = $this->faker->word();

        $this->assertSame($value, TypeAs::string(new MagicStringableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_stringify_open_resource(): void
    {
        $this->assertIsString(TypeAs::string(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?string $value) => $value;

        $this->assertIsString($test(TypeAs::string($this->faker->randomNumber())));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exception_with_message(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsString ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat, $customException)
            ->string(null);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsString]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::string(null);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exception_without_message(): void
    {
        $defaultMessage = 'Resolution error converting NULL [AsString]';
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($defaultMessage);

        // throw a custom exception
        TypeAs::onError(exception: $customException)
            ->string(null);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_throw_message_without_exception(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsString ' . $rng;
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat)
            ->string(null);
    }
}
