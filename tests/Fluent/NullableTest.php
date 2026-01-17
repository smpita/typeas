<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\TypeAs;

class NullableTest extends TestCase
{
    protected function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_array_resolver(): void
    {
        $resolver = new FluentNullableArrayResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->using($resolver)->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_the_global_array_resolver(): void
    {
        $resolver = new FluentNullableArrayResolverStub();
        TypeAs::setNullableArrayResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_array_wrap(): void
    {
        $string = $this->faker->sentence();

        $this->assertSame([$string], Nullable::new()->from($string)->wrap()->toArray());

        $this->assertNull(Nullable::new()->from($string)->wrap(enabled: false)->toArray());

        $this->assertNull(Nullable::new()->from($string)->noWrap()->toArray());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_bool_resolver(): void
    {
        $resolver = new FluentNullableBoolResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->using($resolver)->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_the_global_bool_resolver(): void
    {
        $resolver = new FluentNullableBoolResolverStub();
        TypeAs::setNullableBoolResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_class_resolver(): void
    {
        $resolver = new FluentNullableClassResolverStub();

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ClassStub::class, 'test'),
            Nullable::new()->from('test')->using($resolver)->toClass(ClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_class_resolver(): void
    {
        $resolver = new FluentNullableClassResolverStub();
        TypeAs::setNullableClassResolver($resolver);

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ClassStub::class, 'test'),
            Nullable::new()->from('test')->toClass(ClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_float_resolver(): void
    {
        $resolver = new FluentNullableFloatResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->using($resolver)->toFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_float_resolver(): void
    {
        $resolver = new FluentNullableFloatResolverStub();
        TypeAs::setNullableFloatResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->toFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_int_resolver(): void
    {
        $resolver = new FluentNullableIntResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->using($resolver)->toInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_int_resolver(): void
    {
        $resolver = new FluentNullableIntResolverStub();
        TypeAs::setNullableIntResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->toInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_string_resolver(): void
    {
        $resolver = new FluentNullableStringResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->using($resolver)->toString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_string_resolver(): void
    {
        $resolver = new FluentNullableStringResolverStub();
        TypeAs::setNullableStringResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::new()->from('test')->toString(),
        );
    }
}

class FluentNullableClassStub
{
}

class FluentNullableArrayResolverStub implements NullableArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array
    {
        return null;
    }
}

class FluentNullableBoolResolverStub implements NullableBoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return null;
    }
}

class FluentNullableClassResolverStub implements NullableClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function resolve(string $class, mixed $value, ?object $default = null)
    {
        return null;
    }
}

class FluentNullableFloatResolverStub implements NullableFloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float
    {
        return null;
    }
}

class FluentNullableIntResolverStub implements NullableIntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return null;
    }
}

class FluentNullableStringResolverStub implements NullableStringResolver
{
    public function resolve(mixed $value, ?string $default = null): ?string
    {
        return null;
    }
}
