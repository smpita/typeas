<?php

namespace Smpita\TypeAs\Tests\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;
use StdClass;

class AsClassTest extends TestCase
{
    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canTypeClasses(): void
    {
        $this->assertInstanceOf(ParentStub::class, TypeAs::class(new ParentStub, ParentStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canInferFromChildrenClasses(): void
    {
        $this->assertInstanceOf(ParentStub::class, TypeAs::class(new ChildStub(), ParentStub::class));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionOnWrongClass(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::class(new ParentStub, ChildStub::class);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willThrowExceptionOnNonObjects(): void
    {
        $this->expectException(TypeAsResolutionException::class);

        TypeAs::class(ParentStub::class, ParentStub::class);
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function willNotThrowExceptionWithDefaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::class(new ParentStub, ChildStub::class, new StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
    {
        $test = fn (StdClass $value) => $value;

        $this->assertInstanceOf(StdClass::class, $test(new StdClass));
    }
}

class ParentStub
{
}

class ChildStub extends ParentStub
{
}
