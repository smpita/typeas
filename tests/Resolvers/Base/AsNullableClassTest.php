<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use StdClass;

class AsNullableClassTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_type_classes(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableParentStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_infer_from_children_classes(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableChildStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_wrong_class(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_non_objects(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableParentStub::class, NullableParentStub::class));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_return_null_with_defaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub(), new StdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?NullableParentStub $value) => $value;

        $this->assertInstanceOf(NullableChildStub::class, $test(TypeAs::nullableClass(NullableChildStub::class, new NullableChildStub())));
    }
}

class NullableParentStub
{
}

class NullableChildStub extends NullableParentStub
{
}
