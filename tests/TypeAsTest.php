<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\ArrayResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\BoolResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\ClassResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\FloatResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\IntResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableArrayResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableBoolResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableClassResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableFloatResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableIntResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableStringResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\StringResolverStub;
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
        TypeAs::setArrayResolver($resolver);

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
        TypeAs::setBoolResolver($resolver);

        $this->assertSame($resolver->resolve('test'), TypeAs::nullableBool('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_class_resolver(): void
    {
        $resolver = new ClassResolverStub();

        $this->assertEqualsCanonicalizing($resolver->resolve(ParentClassStub::class, 'test'), TypeAs::class(ParentClassStub::class, 'test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_class_resolver(): void
    {
        $resolver = new ClassResolverStub();
        TypeAs::setClassResolver($resolver);

        $this->assertEqualsCanonicalizing($resolver->resolve(ParentClassStub::class, 'test'), TypeAs::class(ParentClassStub::class, 'test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_use_inline_nullable_class_resolver(): void
    {
        $resolver = new NullableClassResolverStub();

        $this->assertSame($resolver->resolve(ParentClassStub::class, 'test'), TypeAs::nullableClass(ParentClassStub::class, 'test', null, $resolver));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_set_nullable_class_resolver(): void
    {
        $resolver = new NullableClassResolverStub();
        TypeAs::setClassResolver($resolver);

        $this->assertSame($resolver->resolve(ParentClassStub::class, 'test'), TypeAs::nullableClass(ParentClassStub::class, 'test'));
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
        TypeAs::setFloatResolver($resolver);

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
        TypeAs::setIntResolver($resolver);

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
        TypeAs::setStringResolver($resolver);

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

        $value = (new ReflectionClass(TypeAs::getInstance()))
            ->getProperty($key)
            ->getValue(TypeAs::getInstance());

        $this->assertNotNull($value);
        $this->assertSame($resolver, $value);

        TypeAs::useDefaultResolvers();

        $value = (new ReflectionClass(TypeAs::getInstance()))
            ->getProperty($key)
            ->getValue(TypeAs::getInstance());

        $this->assertNull($value);
    }

    public static function resolverProvider(): array
    {
        return [
            ['arrayResolver', new ArrayResolverStub()],
            ['boolResolver', new BoolResolverStub()],
            ['classResolver', new ClassResolverStub()],
            ['floatResolver', new FloatResolverStub()],
            ['intResolver', new IntResolverStub()],
            ['stringResolver', new StringResolverStub()],
        ];
    }
}
