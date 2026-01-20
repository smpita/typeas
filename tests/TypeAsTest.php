<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeAs;

class TypeAsTest extends TestCase
{
    protected function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_array_resolver(): void
    {
        $resolver = new ArrayResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::array('test', resolver: $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_array_resolver(): void
    {
        $resolver = new ArrayResolverStub();
        TypeAs::setArrayResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::array('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_array_resolver(): void
    {
        $resolver = new NullableArrayResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableArray('test', resolver: $resolver, wrap: false));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_array_resolver(): void
    {
        $resolver = new NullableArrayResolverStub();
        TypeAs::setNullableArrayResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableArray('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_bool_resolver(): void
    {
        $resolver = new BoolResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::bool('test', false, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_bool_resolver(): void
    {
        $resolver = new BoolResolverStub();
        TypeAs::setBoolResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::bool('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_bool_resolver(): void
    {
        $resolver = new NullableBoolResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableBool('test', false, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_bool_resolver(): void
    {
        $resolver = new NullableBoolResolverStub();
        TypeAs::setNullableBoolResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableBool('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_class_resolver(): void
    {
        $resolver = new ClassResolverStub();

        $this->assertEqualsCanonicalizing($resolver->resolve(ClassStub::class, 'test'), TypeAs::class(ClassStub::class, 'test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_class_resolver(): void
    {
        $resolver = new ClassResolverStub();
        TypeAs::setClassResolver($resolver);

        $this->assertEqualsCanonicalizing($resolver->resolve(ClassStub::class, 'test'), TypeAs::class(ClassStub::class, 'test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_class_resolver(): void
    {
        $resolver = new NullableClassResolverStub();

        $this->assertSame($resolver->resolve(ClassStub::class, 'test'), TypeAs::nullableClass(ClassStub::class, 'test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_class_resolver(): void
    {
        $resolver = new NullableClassResolverStub();
        TypeAs::setNullableClassResolver($resolver);

        $this->assertSame($resolver->resolve(ClassStub::class, 'test'), TypeAs::nullableClass(ClassStub::class, 'test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_float_resolver(): void
    {
        $resolver = new FloatResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::float('test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_float_resolver(): void
    {
        $resolver = new FloatResolverStub();
        TypeAs::setFloatResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::float('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_float_resolver(): void
    {
        $resolver = new NullableFloatResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableFloat('test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_float_resolver(): void
    {
        $resolver = new NullableFloatResolverStub();
        TypeAs::setNullableFloatResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableFloat('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_int_resolver(): void
    {
        $resolver = new IntResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::int('test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_int_resolver(): void
    {
        $resolver = new IntResolverStub();
        TypeAs::setIntResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::int('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_int_resolver(): void
    {
        $resolver = new NullableIntResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableInt('test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_int_resolver(): void
    {
        $resolver = new NullableIntResolverStub();
        TypeAs::setNullableIntResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableInt('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_string_resolver(): void
    {
        $resolver = new StringResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::string('test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_string_resolver(): void
    {
        $resolver = new StringResolverStub();
        TypeAs::setStringResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::string('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_string_resolver(): void
    {
        $resolver = new NullableStringResolverStub();

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableString('test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_string_resolver(): void
    {
        $resolver = new NullableStringResolverStub();
        TypeAs::setNullableStringResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableString('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[DataProvider('resolverProvider')]
    public function test_can_reset_resolvers(string $key, mixed $resolver): void
    {
        $setResolverMethod = 'set'.ucfirst($key);
        TypeAs::getInstance()->$setResolverMethod($resolver);

        $value = new ReflectionClass(TypeAs::getInstance())
            ->getProperty($key)
            ->getValue(TypeAs::getInstance());

        $this->assertNotNull($value);
        $this->assertSame($resolver, $value);

        TypeAs::useDefaultResolvers();

        $value = new ReflectionClass(TypeAs::getInstance())
            ->getProperty($key)
            ->getValue(TypeAs::getInstance());

        $this->assertNull($value);
    }

    public static function resolverProvider(): array
    {
        return [
            ['nullableArrayResolver', new NullableArrayResolverStub()],
            ['nullableBoolResolver', new NullableBoolResolverStub()],
            ['nullableClassResolver', new NullableClassResolverStub()],
            ['nullableFloatResolver', new NullableFloatResolverStub()],
            ['nullableIntResolver', new NullableIntResolverStub()],
            ['nullableStringResolver', new NullableStringResolverStub()],
            ['arrayResolver', new ArrayResolverStub()],
            ['boolResolver', new BoolResolverStub()],
            ['classResolver', new ClassResolverStub()],
            ['floatResolver', new FloatResolverStub()],
            ['intResolver', new IntResolverStub()],
            ['stringResolver', new StringResolverStub()],
        ];
    }
}

class ClassStub
{
}

class ArrayResolverStub implements ArrayResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): array
    {
        return [];
    }
}

class BoolResolverStub implements BoolResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        return false;
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
     * @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException
     */
    public function resolve(string $class, mixed $value, ?object $default = null)
    {
        if (class_exists($class)) {
            return new $class();
        }

        throw new TypeAsResolutionException();
    }
}

class FloatResolverStub implements FloatResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?float $default = null): float
    {
        return 0.0;
    }
}

class IntResolverStub implements IntResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?int $default = null): int
    {
        return 0;
    }
}

class StringResolverStub implements StringResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?string $default = null): string
    {
        return '';
    }
}

class NullableArrayResolverStub implements NullableArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array
    {
        return null;
    }
}

class NullableBoolResolverStub implements NullableBoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
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
    public function resolve(string $class, mixed $value, ?object $default = null)
    {
        return null;
    }
}

class NullableFloatResolverStub implements NullableFloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float
    {
        return null;
    }
}

class NullableIntResolverStub implements NullableIntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return null;
    }
}

class NullableStringResolverStub implements NullableStringResolver
{
    public function resolve(mixed $value, ?string $default = null): ?string
    {
        return null;
    }
}
