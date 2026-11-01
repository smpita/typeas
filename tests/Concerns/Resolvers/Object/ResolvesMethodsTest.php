<?php

namespace Smpita\TypeAs\Tests\Concerns\Resolvers\Object;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\NotCallableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MethodObjectStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MethodObjectStubWithNonCallableFirst;
use Smpita\TypeAs\Tests\Stubs\Objects\NullReturning;
use Smpita\TypeAs\Tests\Stubs\Objects\OnlySecond;
use Smpita\TypeAs\Tests\Stubs\Objects\ResolvesMethodsStub;
use Smpita\TypeAs\Tests\TestCase;

class ResolvesMethodsTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_value_for_callable_public_method(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new MethodObjectStub(['hello' => 'world']);

        $this->assertSame('world', $stub->resolveMethod($object, 'hello'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_null_when_method_does_not_exist(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new MethodObjectStub();

        $this->assertNull($stub->resolveMethod($object, 'nonExistent'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_null_when_method_exists_but_is_not_callable(): void
    {
        $stub = new ResolvesMethodsStub();

        $this->assertNull($stub->resolveMethod(new NotCallableStub(), '__toArray'));
        $this->assertNull($stub->resolveMethod(new NotCallableStub(), 'toArray'));
        $this->assertNull($stub->resolveMethod(new NotCallableStub(), '__toBool'));
        $this->assertNull($stub->resolveMethod(new NotCallableStub(), 'toBool'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_returns_first_callable_result(): void
    {
        $object = new MethodObjectStub(['first' => 'first', 'second' => 'second']);
        $stub = new ResolvesMethodsStub();

        $this->assertSame('first', $stub->resolveMethods($object, ['first', 'second']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_skips_non_callable_and_returns_second(): void
    {
        $object = new MethodObjectStubWithNonCallableFirst();
        $stub = new ResolvesMethodsStub();

        $this->assertSame('second', $stub->resolveMethods($object, ['first', 'second']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_skips_nonexistent_method_and_returns_second(): void
    {
        $object = new OnlySecond();
        $stub = new ResolvesMethodsStub();

        $this->assertSame('second', $stub->resolveMethods($object, ['first', 'second']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_returns_null_when_no_methods_are_callable(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new NotCallableStub();

        $this->assertNull($stub->resolveMethods($object, ['toInt', 'toString']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_returns_null_when_all_methods_return_null(): void
    {
        $object = new NullReturning();
        $stub = new ResolvesMethodsStub();

        $this->assertNull($stub->resolveMethods($object, ['first', 'second']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_non_null_result_from_callable_method(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new MethodObjectStub(['getValue' => 42]);

        $this->assertSame(42, $stub->resolveMethod($object, 'getValue'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_precedence_first_callble_wins(): void
    {
        $object = new MethodObjectStub(['first' => 'first', 'second' => 'second', 'third' => 'third']);
        $stub = new ResolvesMethodsStub();

        $this->assertSame('third', $stub->resolveMethods($object, ['third', 'first', 'second']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_works_with_not_callable_stub(): void
    {
        $stub = new ResolvesMethodsStub();
        $notCallable = new NotCallableStub();

        $this->assertNull($stub->resolveMethod($notCallable, 'toInt'));
        $this->assertNull($stub->resolveMethod($notCallable, '__toInt'));
        $this->assertNull($stub->resolveMethod($notCallable, 'toInteger'));
        $this->assertNull($stub->resolveMethod($notCallable, '__toFloat'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_all_public_methods_exist_and_callable(): void
    {
        $object = new MethodObjectStub(['methodA' => 'a', 'methodB' => 'b', 'methodC' => 'c']);
        $stub = new ResolvesMethodsStub();

        $this->assertSame('a', $stub->resolveMethods($object, ['methodA', 'methodB', 'methodC']));
        $this->assertSame('b', $stub->resolveMethods($object, ['notExists', 'methodB', 'methodC']));
        $this->assertSame('c', $stub->resolveMethods($object, ['notExists', 'alsoNot', 'methodC']));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_with_empty_methods_array_returns_null(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new MethodObjectStub();

        $this->assertNull($stub->resolveMethods($object, []));
    }
}
