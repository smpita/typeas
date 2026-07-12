<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
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
        $this->assertInstanceOf(ParentClassStub::class, TypeAs::nullableClass(ParentClassStub::class, new ParentClassStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_infer_from_children_classes(): void
    {
        $this->assertInstanceOf(ParentClassStub::class, TypeAs::nullableClass(ParentClassStub::class, new ChildClassStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_wrong_class(): void
    {
        $this->assertNull(TypeAs::nullableClass(ChildClassStub::class, new ParentClassStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_return_null_on_non_objects(): void
    {
        $this->assertNull(TypeAs::nullableClass(ParentClassStub::class, ParentClassStub::class));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_will_not_return_null_with_defaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::nullableClass(ChildClassStub::class, new ParentClassStub(), new StdClass()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?ParentClassStub $value) => $value;

        $this->assertInstanceOf(ChildClassStub::class, $test(TypeAs::nullableClass(ChildClassStub::class, new ChildClassStub())));
    }
}
