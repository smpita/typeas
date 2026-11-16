<?php

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class ClassTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_pass_static_analysis(): void
    {
        $test = fn (ParentClassStub $value) => $value;
        $value = new ChildClassStub();

        $this->assertInstanceOf(ChildClassStub::class, $test(TypeAs::class(ChildClassStub::class, $value)));
        $this->assertInstanceOf(ChildClassStub::class, $test(\asClass(ChildClassStub::class, $value)));
        $this->assertInstanceOf(ChildClassStub::class, $test(\Smpita\TypeAs\asClass(ChildClassStub::class, $value)));
        $this->assertInstanceOf(ChildClassStub::class, $test(type($value)->asClass(ChildClassStub::class)));

        $this->assertInstanceOf(ParentClassStub::class, $test(TypeAs::nullableClass(ChildClassStub::class, $value)));
        $this->assertInstanceOf(ParentClassStub::class, $test(\asNullableClass(ChildClassStub::class, $value)));
        $this->assertInstanceOf(ParentClassStub::class, $test(\Smpita\TypeAs\asNullableClass(ChildClassStub::class, $value)));
        $this->assertInstanceOf(ParentClassStub::class, $test(type($value)->nullable()->asClass(ChildClassStub::class)));
    }
}
