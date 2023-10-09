<?php

namespace Smpita\TypeAs\Tests;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\TypeAs;
use UnexpectedValueException;

class TypeAsTest extends TestCase
{
    protected function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetArrayResolver(): void
    {
        $resolver = new ArrayResolverStub;
        TypeAs::setArrayResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::array('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetClassResolver(): void
    {
        $resolver = new ClassResolverStub;
        TypeAs::setClassResolver($resolver);

        $this->assertEqualsCanonicalizing($resolver->resolve(ClassStub::class, 'test'), TypeAs::class(ClassStub::class, 'test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetFloatResolver(): void
    {
        $resolver = new FloatResolverStub;
        TypeAs::setFloatResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::float('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetIntResolver(): void
    {
        $resolver = new IntResolverStub;
        TypeAs::setIntResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::int('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetNullableArrayResolver(): void
    {
        $resolver = new NullableArrayResolverStub;
        TypeAs::setNullableArrayResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableArray('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetNullableClassResolver(): void
    {
        $resolver = new NullableClassResolverStub;
        TypeAs::setNullableClassResolver($resolver);

        $this->assertSame($resolver->resolve(ClassStub::class, 'test'), TypeAs::nullableClass(ClassStub::class, 'test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetNullableFloatResolver(): void
    {
        $resolver = new NullableFloatResolverStub;
        TypeAs::setNullableFloatResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableFloat('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetNullableIntResolver(): void
    {
        $resolver = new NullableIntResolverStub;
        TypeAs::setNullableIntResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableInt('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetNullableStringResolver(): void
    {
        $resolver = new NullableStringResolverStub;
        TypeAs::setNullableStringResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableString('test'));
    }

    /**
     * @test
     *
     * @group smpita
     * @group typeas
     */
    public function canSetStringResolver(): void
    {
        $resolver = new StringResolverStub;
        TypeAs::setStringResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::string('test'));
    }
}

class ClassStub
{
}

class ArrayResolverStub implements ArrayResolver
{
    /** @throws \UnexpectedValueException */
    public function resolve(mixed $value, bool|array $wrap = true): array
    {
        return [];
    }
}

class ClassResolverStub implements ClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws UnexpectedValueException
     */
    public function resolve(string $class, mixed $value, object $default = null)
    {
        if (class_exists($class)) {
            return new $class;
        }

        throw new UnexpectedValueException;
    }
}

class FloatResolverStub implements FloatResolver
{
    /** @throws \UnexpectedValueException */
    public function resolve(mixed $value, float $default = null): float
    {
        return 0.0;
    }
}

class IntResolverStub implements IntResolver
{
    /** @throws \UnexpectedValueException */
    public function resolve(mixed $value, int $default = null): int
    {
        return 0;
    }
}

class NullableArrayResolverStub implements NullableArrayResolver
{
    public function resolve(mixed $value, bool|array $wrap = true): ?array
    {
        return null;
    }
}

class NullableClassResolverStub implements NullableClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function resolve(string $class, mixed $value, object $default = null)
    {
        return null;
    }
}

class NullableFloatResolverStub implements NullableFloatResolver
{
    public function resolve(mixed $value, float $default = null): ?float
    {
        return null;
    }
}

class NullableIntResolverStub implements NullableIntResolver
{
    public function resolve(mixed $value, int $default = null): ?int
    {
        return null;
    }
}

class NullableStringResolverStub implements NullableStringResolver
{
    public function resolve(mixed $value, string $default = null): ?string
    {
        return null;
    }
}

class StringResolverStub implements StringResolver
{
    /** @throws \UnexpectedValueException */
    public function resolve(mixed $value, string $default = null): string
    {
        return '';
    }
}
