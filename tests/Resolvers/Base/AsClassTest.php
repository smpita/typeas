<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use StdClass;

class AsClassTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_type_classes(): void
    {
        $this->assertInstanceOf(ParentClassStub::class, TypeAs::class(ParentClassStub::class, new ParentClassStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_infer_from_children_classes(): void
    {
        $this->assertInstanceOf(ParentClassStub::class, TypeAs::class(ParentClassStub::class, new ChildClassStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_wrong_class(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::class(ChildClassStub::class, new ParentClassStub());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_throw_exception_on_non_objects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::class(ParentClassStub::class, ParentClassStub::class);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::class(ChildClassStub::class, new ParentClassStub(), new StdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (ParentClassStub $value) => $value;

        $this->assertInstanceOf(ChildClassStub::class, $test(TypeAs::class(ChildClassStub::class, new ChildClassStub())));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();

        $customMessage = 'resolved NULL with AsClass ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        TypeAs::onError($customErrorFormat, $customException)
            ->class(self::class, null);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsClass]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        TypeAs::class(self::class, null);
    }
}
