<?php

namespace Smpita\TypeAs\Tests\Throwing;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Testing\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class FilterBoolTest extends TestCase
{
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
}
