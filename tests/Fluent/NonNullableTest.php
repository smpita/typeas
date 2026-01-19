<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Fluent\TypeConfig;
use Smpita\TypeAs\TypeAs;
use stdClass;

class NonNullableTest extends TestCase
{
    protected function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_create_a_new_instance(): void
    {
        $this->assertInstanceOf(NonNullable::class, NonNullable::make());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_copy_to_a_new_instance(): void
    {
        $instance = NonNullable::make()
            ->from($this->faker->word())
            ->default($this->faker->word())
            ->using(new FluentNonNullableArrayResolverStub())
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
        $this->assertInstanceOf(TypeConfig::class, NonNullable::make()->config());

        $this->assertInstanceOf(TypeConfig::class, (new NonNullable())->config());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_import_a_type_config(): void
    {
        $config = new TypeConfig(
            fromValue: $this->faker->word(),
        );

        $this->assertSame($config, NonNullable::make($config)->config());

        $this->assertSame($config, (new NonNullable())->import($config)->config());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_array_default(): void
    {
        $default = [$this->faker->word];

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_array_wrap(): void
    {
        $string = $this->faker->sentence();

        $this->assertSame([$string], NonNullable::make()->from($string)->wrap()->toArray());

        $this->expectException(TypeAsResolutionException::class);
        NonNullable::make()->from($string)->wrap(enabled: false)->toArray();

        $this->expectException(TypeAsResolutionException::class);
        NonNullable::make()->from($string)->noWrap()->toArray();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_array_resolver(): void
    {
        $resolver = new FluentNonNullableArrayResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->using($resolver)->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_the_global_array_resolver(): void
    {
        $resolver = new FluentNonNullableArrayResolverStub();
        TypeAs::setArrayResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->toArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_bool_default(): void
    {
        $default = false;

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_bool_resolver(): void
    {
        $resolver = new FluentNonNullableBoolResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->using($resolver)->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_the_global_bool_resolver(): void
    {
        $resolver = new FluentNonNullableBoolResolverStub();
        TypeAs::setBoolResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->toBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_filter_bool_default(): void
    {
        $default = false;

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toFilterBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_class_default(): void
    {
        $default = new stdClass();

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toClass(stdClass::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_class_resolver(): void
    {
        $resolver = new FluentNonNullableClassResolverStub();

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ClassStub::class, 'test'),
            NonNullable::make()->from('test')->using($resolver)->toClass(ClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_class_resolver(): void
    {
        $resolver = new FluentNonNullableClassResolverStub();
        TypeAs::setClassResolver($resolver);

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ClassStub::class, 'test'),
            NonNullable::make()->from('test')->toClass(ClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_float_default(): void
    {
        $default = $this->faker->randomFloat();

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_float_resolver(): void
    {
        $resolver = new FluentNonNullableFloatResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->using($resolver)->toFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_float_resolver(): void
    {
        $resolver = new FluentNonNullableFloatResolverStub();
        TypeAs::setFloatResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->toFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_int_default(): void
    {
        $default = $this->faker->randomNumber(4);

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_int_resolver(): void
    {
        $resolver = new FluentNonNullableIntResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->using($resolver)->toInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_int_resolver(): void
    {
        $resolver = new FluentNonNullableIntResolverStub();
        TypeAs::setIntResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->toInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_string_default(): void
    {
        $default = $this->faker->sentence();

        $this->assertSame(
            $default,
            NonNullable::make()->from(null)->default($default)->toString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_string_resolver(): void
    {
        $resolver = new FluentNonNullableStringResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->using($resolver)->toString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_string_resolver(): void
    {
        $resolver = new FluentNonNullableStringResolverStub();
        TypeAs::setStringResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->from('test')->toString(),
        );
    }
}

class FluentNonNullableClassStub
{
}

class FluentNonNullableArrayResolverStub implements ArrayResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): array
    {
        return [];
    }
}

class FluentNonNullableBoolResolverStub implements BoolResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        return false;
    }
}

class FluentNonNullableClassResolverStub implements ClassResolver
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

class FluentNonNullableFloatResolverStub implements FloatResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?float $default = null): float
    {
        return 0.0;
    }
}

class FluentNonNullableIntResolverStub implements IntResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?int $default = null): int
    {
        return 0;
    }
}

class FluentNonNullableStringResolverStub implements StringResolver
{
    /** @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException */
    public function resolve(mixed $value, ?string $default = null): string
    {
        return '';
    }
}
