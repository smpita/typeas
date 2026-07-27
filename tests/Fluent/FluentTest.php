<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\TypeAs;

class FluentTest extends TestCase
{
    protected function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_non_nullable_instance(): void
    {
        $this->assertInstanceOf(NonNullable::class, TypeAs::type('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_nullable_instance(): void
    {
        $this->assertInstanceOf(Nullable::class, TypeAs::type('test')->nullable());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_non_nullable_instance_from_a_nullable_instance(): void
    {
        $this->assertInstanceOf(NonNullable::class, TypeAs::type('test')->nullable()->nonNullable());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_array_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsArray]';
        $defaultException = TypeAsResolutionException::class;

        type([])
            ->onError($customMessage, $customException)
            ->noWrap()
            ->asArray();

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->noWrap()
            ->asArray();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_bool_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsBool]';
        $defaultException = TypeAsResolutionException::class;

        type(false)
            ->onError($customMessage, $customException)
            ->asBool();

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->asBool();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_class_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsClass]';
        $defaultException = TypeAsResolutionException::class;

        type(new ParentClassStub())
            ->onError($customMessage, $customException)
            ->asClass(ParentClassStub::class);

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->asClass(ParentClassStub::class);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_filter_bool_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsFilterBool]';
        $defaultException = TypeAsResolutionException::class;

        type(false)
            ->onError($customMessage, $customException)
            ->asFilterBool();

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->asFilterBool();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_float_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsFloat]';
        $defaultException = TypeAsResolutionException::class;

        type(0.0)
            ->onError($customMessage, $customException)
            ->asFloat();

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->asFloat();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_int_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsInt]';
        $defaultException = TypeAsResolutionException::class;

        type(0)
            ->onError($customMessage, $customException)
            ->asInt();

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->asInt();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_string_does_not_leak_custom_error_handling(): void
    {
        $customMessage = $this->faker->sentence();
        $customException = CustomExceptionStub::class;
        $defaultMessage = 'Resolution error converting NULL [AsString]';
        $defaultException = TypeAsResolutionException::class;

        type('')
            ->onError($customMessage, $customException)
            ->asString();

        // it should not persist to the subsequent exception handling
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        type(null)
            ->asString();
    }
}
