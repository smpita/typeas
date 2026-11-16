<?php

namespace Smpita\TypeAs\Tests\Concerns\Resolvers\Object;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ResolvesMethodsStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\MultiStub;
use Smpita\TypeAs\Tests\TestCase;

class ResolvesMethodsTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_value_for_callable_public_method(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $this->assertSame($value, $stub->resolveMethod($object, 'toString'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_null_when_method_does_not_exist(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub();

        $this->assertNull($stub->resolveMethod($object, 'nonExistent'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_null_when_method_exists_but_is_not_callable(): void
    {
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub();

        $this->assertNull($stub->resolveMethod($object, 'protected'));
        $this->assertNull($stub->resolveMethod($object, 'private'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_returns_first_callable_result(): void
    {
        $value = $this->faker->randomNumber();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $toIntFirst = $stub->resolveMethods($object, ['toInt', 'toString']);
        $toStringFirst = $stub->resolveMethods($object, ['toString', 'toInt']);

        $this->assertIsInt($toIntFirst);
        $this->assertIsNotString($toIntFirst);
        $this->assertSame((int) $value, $toIntFirst);

        $this->assertIsString($toStringFirst);
        $this->assertIsNotInt($toStringFirst);
        $this->assertSame((string) $value, $toStringFirst);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_skips_non_callable_and_returns_callable(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $resolved = $stub->resolveMethods($object, ['protected', 'private', 'toString']);

        $this->assertSame($value, $resolved);
        $this->assertNotSame(MultiStub::PROTECTED_VALUE, $resolved);
        $this->assertNotSame(MultiStub::PRIVATE_VALUE, $resolved);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_skips_nonexistent_method_and_returns_callable(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $resolved = $stub->resolveMethods($object, ['nonExistent', 'toString']);

        $this->assertSame($value, $resolved);
        $this->assertNotSame(MultiStub::PROTECTED_VALUE, $resolved);
        $this->assertNotSame(MultiStub::PRIVATE_VALUE, $resolved);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_returns_null_when_no_methods_are_callable(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $resolved = $stub->resolveMethods($object, ['nonExistent', 'protected', 'private']);

        $this->assertNull($resolved);
        $this->assertNotSame($value, $resolved);
        $this->assertNotSame(MultiStub::PROTECTED_VALUE, $resolved);
        $this->assertNotSame(MultiStub::PRIVATE_VALUE, $resolved);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_returns_null_when_all_methods_return_null(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $resolved = $stub->resolveMethods($object, ['__toNull', 'toNull']);

        $this->assertNull($resolved);
        $this->assertNotSame($value, $resolved);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethod_returns_non_null_result_from_callable_method(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $resolved = $stub->resolveMethods($object, ['toString']);

        $this->assertSame($value, $resolved);
        $this->assertNotNull($resolved);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_resolveMethods_without_methods_names_returns_null(): void
    {
        $value = $this->faker->sentence();
        $stub = new ResolvesMethodsStub();
        $object = new MultiStub($value);

        $resolved = $stub->resolveMethods($object, []);

        $this->assertNull($resolved);
        $this->assertNotSame($value, $resolved);
    }
}
