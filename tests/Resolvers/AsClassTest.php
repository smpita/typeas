<?php

namespace Smpita\TypeAs\Tests\Resolvers;

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
        $this->assertInstanceOf(ParentStub::class, TypeAs::class(ParentStub::class, new ParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canInferFromChildrenClasses(): void
    {
        $this->assertInstanceOf(ParentStub::class, TypeAs::class(ParentStub::class, new ChildStub()));
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

        TypeAs::class(ChildStub::class, new ParentStub);
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
        $this->assertInstanceOf(StdClass::class, TypeAs::class(ChildStub::class, new ParentStub, new StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canPassStaticAnalysis(): void
    {
        $test = fn (ParentStub $value) => $value;

        $this->assertInstanceOf(ChildStub::class, $test(TypeAs::class(ChildStub::class, new ChildStub)));
    }
}

class ParentStub
{
}

class ChildStub extends ParentStub
{
}
