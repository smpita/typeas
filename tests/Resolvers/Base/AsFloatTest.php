<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\FloatableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicFloatableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsFloatTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_on_unfloatable_types(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::float([]);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_on_unfloatable_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::float(new \StdClass());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_with_defaults(): void
    {
        $this->assertSame(0.0, TypeAs::float(new \StdClass(), 0.0));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_booleans(): void
    {
        $this->assertIsFloat(TypeAs::float($this->faker->boolean()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_floatable_objects(): void
    {
        $value = $this->faker->randomFloat();

        $this->assertSame($value, TypeAs::float(new FloatableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_magic_floatable_objects(): void
    {
        $value = $this->faker->randomFloat();

        $this->assertSame($value, TypeAs::float(new MagicFloatableStub($value)));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_integers(): void
    {
        $this->assertSame(1234567890.0, TypeAs::float(1234567890));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_floats(): void
    {
        $float = $this->faker->randomFloat();

        $this->assertSame($float, TypeAs::float($float));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_open_resource(): void
    {
        $this->assertIsFloat(TypeAs::float(stream_context_create()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_floatify_strings(): void
    {
        $this->assertSame(1234567890.0, TypeAs::float('0001234567890.000'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (float $value) => $value;

        $this->assertIsFloat($test(TypeAs::float($this->faker->randomNumber())));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsFloat ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat, $customException)
            ->float(null);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsFloat]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::float(null);
    }
}
