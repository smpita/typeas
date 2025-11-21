<?php

namespace Smpita\TypeAs\Tests\Resolvers;

use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use StdClass;

class AsNullableClassTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_type_classes(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_infer_from_children_classes(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableChildStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_return_null_on_wrong_class(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_return_null_on_non_objects(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableParentStub::class, NullableParentStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_not_return_null_with_defaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub, new StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (?NullableParentStub $value) => $value;

        $this->assertInstanceOf(NullableChildStub::class, $test(TypeAs::nullableClass(NullableChildStub::class, new NullableChildStub)));
    }
}

class NullableParentStub {}

class NullableChildStub extends NullableParentStub {}
