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
    public function testCanTypeClasses(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanInferFromChildrenClasses(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableChildStub()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnWrongClass(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillReturnNullOnNonObjects(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableParentStub::class, NullableParentStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testWillNotReturnNullWithDefaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub, new StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function testCanPassStaticAnalysis(): void
    {
        $test = fn (?NullableParentStub $value) => $value;

        $this->assertInstanceOf(NullableChildStub::class, $test(TypeAs::nullableClass(NullableChildStub::class, new NullableChildStub)));
    }
}

class NullableParentStub
{
}

class NullableChildStub extends NullableParentStub
{
}
