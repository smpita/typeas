<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\TypeConfig;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableArrayResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableBoolResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableClassResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableFloatResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableIntResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\NullableStringResolverStub;
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
            ->type($this->faker->word())
            ->default($this->faker->word())
            ->using(new NullableArrayResolverStub())
            ->noWrap();

        $assignment = $instance;
        $copy = $instance->copy();
        $clone = clone $instance;

        $this->assertEquals($instance, $assignment);
        $this->assertEquals($instance, $copy);
        $this->assertEquals($instance, $clone);

        $instance->type(null)
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
        $config = new TypeConfig(
            fromValue: $this->faker->word(),
        );

        $this->assertSame($config, Nullable::make($config)->config());

        $this->assertSame($config, (new Nullable())->import($config)->config());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_array_default(): void
    {
        $default = [$this->faker->word];

        $this->assertSame(
            $default,
            Nullable::make()->type(null)->default($default)->asArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_array_resolver(): void
    {
        $resolver = new NullableArrayResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->using($resolver)->asArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_the_global_array_resolver(): void
    {
        $resolver = new NullableArrayResolverStub();
        TypeAs::setArrayResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->asArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_array_wrap(): void
    {
        $string = $this->faker->sentence();

        $this->assertSame([$string], Nullable::make()->type($string)->wrap()->asArray());

        $this->assertNull(Nullable::make()->type($string)->wrap(enabled: false)->asArray());

        $this->assertNull(Nullable::make()->type($string)->noWrap()->asArray());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_bool_default(): void
    {
        $default = true;

        $this->assertSame(
            $default,
            Nullable::make()->type(null)->default($default)->asBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_bool_resolver(): void
    {
        $resolver = new NullableBoolResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->using($resolver)->asBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_the_global_bool_resolver(): void
    {
        $resolver = new NullableBoolResolverStub();
        TypeAs::setBoolResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->asBool(),
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
            Nullable::make()->type(null)->default($default)->asFilterBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_class_default(): void
    {
        $default = new ParentClassStub();

        $this->assertSame(
            $default,
            Nullable::make()->type(null)->default($default)->asClass(ParentClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_class_resolver(): void
    {
        $resolver = new NullableClassResolverStub();

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ParentClassStub::class, 'test'),
            Nullable::make()->type('test')->using($resolver)->asClass(ParentClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_class_resolver(): void
    {
        $resolver = new NullableClassResolverStub();
        TypeAs::setClassResolver($resolver);

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ParentClassStub::class, 'test'),
            Nullable::make()->type('test')->asClass(ParentClassStub::class),
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
            Nullable::make()->type(null)->default($default)->asFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_float_resolver(): void
    {
        $resolver = new NullableFloatResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->using($resolver)->asFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_float_resolver(): void
    {
        $resolver = new NullableFloatResolverStub();
        TypeAs::setFloatResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->asFloat(),
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
            Nullable::make()->type(null)->default($default)->asInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_int_resolver(): void
    {
        $resolver = new NullableIntResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->using($resolver)->asInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_int_resolver(): void
    {
        $resolver = new NullableIntResolverStub();
        TypeAs::setIntResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->asInt(),
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
            Nullable::make()->type(null)->default($default)->asString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_fluent_string_resolver(): void
    {
        $resolver = new NullableStringResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->using($resolver)->asString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_nullable_can_use_global_string_resolver(): void
    {
        $resolver = new NullableStringResolverStub();
        TypeAs::setStringResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            Nullable::make()->type('test')->asString(),
        );
    }
}
