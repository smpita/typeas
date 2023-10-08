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
    public function canTypeClasses(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canInferFromChildrenClasses(): void
    {
        $this->assertInstanceOf(NullableParentStub::class, TypeAs::nullableClass(NullableParentStub::class, new NullableChildStub()));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willReturnNullOnWrongClass(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willReturnNullOnNonObjects(): void
    {
        $this->assertNull(TypeAs::nullableClass(NullableParentStub::class, NullableParentStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotReturnNullWithDefaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::nullableClass(NullableChildStub::class, new NullableParentStub, new StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
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
