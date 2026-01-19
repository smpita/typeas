<?php

namespace Smpita\TypeAs\Tests;

use stdClass;
use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\TypeConfig;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;

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
    public function test_nullable_can_create_a_new_instance(): void
    {
        $this->assertInstanceOf(Nullable::class, Nullable::make());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_copy_to_a_new_instance(): void
    {
        $instance = Nullable::make()
            ->from($this->faker->word())
            ->default($this->faker->word())
            ->using(new FluentNullableArrayResolverStub())
            ->noWrap();

        $assignment = $instance;
        $copy = $instance->copy();
        $clone = clone $instance;

        $this->assertEquals($instance, $assignment);
        $this->assertEquals($instance, $copy);
        $this->assertEquals($instance, $clone);

        $instance->from(null)
            ->default(null)
            ->using(null)
            ->wrap();

        $this->assertEquals($instance, $assignment);
        $this->assertNotEquals($instance, $copy);
        $this->assertNotEquals($instance, $clone);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_create_a_config(): void
    {
        $this->assertInstanceOf(TypeConfig::class, Nullable::make()->config());

        $this->assertInstanceOf(TypeConfig::class, (new Nullable())->config());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_import_a_type_config(): void
    {
        $string = $this->faker->word();

        $config = new TypeConfig(
            fromValue: $string,
            arrayWrap: true,
        );

        $this->assertSame([$string], Nullable::make($config)->toArray());

        $this->assertSame([$string], (new Nullable())->import($config)->toArray());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_array_default(): void
    {
        $default = [$this->faker->word];

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_array_resolver(): void
    {
        $resolver = new FluentNullableArrayResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->from('test')->using($resolver)->toArray(),
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
            Nullable::make()->from('test')->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_array_wrap(): void
    {
        $string = $this->faker->sentence();

        $this->assertSame([$string], Nullable::make()->from($string)->wrap()->toArray());

        $this->assertNull(Nullable::make()->from($string)->wrap(enabled: false)->toArray());

        $this->assertNull(Nullable::make()->from($string)->noWrap()->toArray());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_bool_default(): void
    {
        $default = true;

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_bool_resolver(): void
    {
        $resolver = new FluentNullableBoolResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->from('test')->using($resolver)->toBool(),
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
            Nullable::make()->from('test')->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_filter_bool_default(): void
    {
        $default = false;

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toFilterBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_class_default(): void
    {
        $default = new stdClass();

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toClass(stdClass::class),
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
            Nullable::make()->from('test')->using($resolver)->toClass(ClassStub::class),
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
            Nullable::make()->from('test')->toClass(ClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_float_default(): void
    {
        $default = $this->faker->randomFloat();

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toFloat(),
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
            Nullable::make()->from('test')->using($resolver)->toFloat(),
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
            Nullable::make()->from('test')->toFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_int_default(): void
    {
        $default = $this->faker->randomNumber(4);

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toInt(),
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
            Nullable::make()->from('test')->using($resolver)->toInt(),
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
            Nullable::make()->from('test')->toInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_string_default(): void
    {
        $default = $this->faker->sentence();

        $this->assertSame(
            $default,
            Nullable::make()->from(null)->default($default)->toString(),
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
            Nullable::make()->from('test')->using($resolver)->toString(),
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
            Nullable::make()->from('test')->toString(),
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
