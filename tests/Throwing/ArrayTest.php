<?php

namespace Smpita\TypeAs\Tests\Throwing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Testing\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class ArrayTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exception_with_message(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsArray ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat, $customException)
            ->array(null, wrap: false);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsArray]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::array(null, wrap: false);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exception_without_message(): void
    {
        $defaultMessage = 'Resolution error converting NULL [AsArray]';
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($defaultMessage);

        // throw a custom exception
        TypeAs::onError(exception: $customException)
            ->array(null, wrap: false);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_throw_message_without_exception(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsArray ' . $rng;
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat)
            ->array(null, wrap: false);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsArray]';
        $defaultException = TypeAsResolutionException::class;

        TypeAs::onError($customMessage, $customException)
            ->array([]);

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::array(null, wrap: false);
    }
}
