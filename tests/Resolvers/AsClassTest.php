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
    public function test_can_type_classes(): void
    {
        $this->assertInstanceOf(ParentStub::class, TypeAs::class(ParentStub::class, new ParentStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_infer_from_children_classes(): void
    {
        $this->assertInstanceOf(ParentStub::class, TypeAs::class(ParentStub::class, new ChildStub));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_will_throw_exception_on_wrong_class(): void
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
    public function test_will_throw_exception_on_non_objects(): void
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
    public function test_will_not_throw_exception_with_defaults(): void
    {
        $this->assertInstanceOf(StdClass::class, TypeAs::class(ChildStub::class, new ParentStub, new StdClass));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (ParentStub $value) => $value;

        $this->assertInstanceOf(ChildStub::class, $test(TypeAs::class(ChildStub::class, new ChildStub)));
    }
}

class ParentStub {}

class ChildStub extends ParentStub {}
