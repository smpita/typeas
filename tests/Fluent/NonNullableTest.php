<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Fluent\NonNullable;
use Smpita\TypeAs\Fluent\TypeConfig;
use Smpita\TypeAs\Tests\Stubs\Exceptions\CustomExceptionStub;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\ArrayResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\BoolResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\ClassResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\FloatResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\IntResolverStub;
use Smpita\TypeAs\Tests\Stubs\Resolvers\StringResolverStub;
use Smpita\TypeAs\TypeAs;

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
            ->type($this->faker->word())
            ->default($this->faker->word())
            ->using(new ArrayResolverStub())
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
            NonNullable::make()->type(null)->default($default)->asArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_array_wrap(): void
    {
        $string = $this->faker->sentence();

        $this->assertSame([$string], NonNullable::make()->type($string)->wrap()->asArray());

        $this->expectException(TypeAsResolutionException::class);
        NonNullable::make()->type($string)->wrap(enabled: false)->asArray();

        $this->expectException(TypeAsResolutionException::class);
        NonNullable::make()->type($string)->noWrap()->asArray();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_array_resolver(): void
    {
        $resolver = new ArrayResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->using($resolver)->asArray(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_the_global_array_resolver(): void
    {
        $resolver = new ArrayResolverStub();
        TypeAs::setArrayResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->asArray(),
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
            NonNullable::make()->type(null)->default($default)->asBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_bool_resolver(): void
    {
        $resolver = new BoolResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->using($resolver)->asBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_the_global_bool_resolver(): void
    {
        $resolver = new BoolResolverStub();
        TypeAs::setBoolResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->asBool(),
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
            NonNullable::make()->type(null)->default($default)->asFilterBool(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_class_default(): void
    {
        $default = new ParentClassStub();

        $this->assertSame(
            $default,
            NonNullable::make()->type(null)->default($default)->asClass(ParentClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_class_resolver(): void
    {
        $resolver = new ClassResolverStub();

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ParentClassStub::class, 'test'),
            NonNullable::make()->type('test')->using($resolver)->asClass(ParentClassStub::class),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_class_resolver(): void
    {
        $resolver = new ClassResolverStub();
        TypeAs::setClassResolver($resolver);

        $this->assertEqualsCanonicalizing(
            $resolver->resolve(ParentClassStub::class, 'test'),
            NonNullable::make()->type('test')->asClass(ParentClassStub::class),
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
            NonNullable::make()->type(null)->default($default)->asFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_float_resolver(): void
    {
        $resolver = new FloatResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->using($resolver)->asFloat(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_float_resolver(): void
    {
        $resolver = new FloatResolverStub();
        TypeAs::setFloatResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->asFloat(),
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
            NonNullable::make()->type(null)->default($default)->asInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_int_resolver(): void
    {
        $resolver = new IntResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->using($resolver)->asInt(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_int_resolver(): void
    {
        $resolver = new IntResolverStub();
        TypeAs::setIntResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->asInt(),
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
            NonNullable::make()->type(null)->default($default)->asString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_fluent_string_resolver(): void
    {
        $resolver = new StringResolverStub();

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->using($resolver)->asString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_non_nullable_can_use_global_string_resolver(): void
    {
        $resolver = new StringResolverStub();
        TypeAs::setStringResolver($resolver);

        $this->assertSame(
            $resolver->resolve('test'),
            NonNullable::make()->type('test')->asString(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_array_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsArray ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->noWrap()
            ->asArray();

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsArray]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs
            ->noWrap()
            ->asArray();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_bool_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsBool ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->asBool();

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsBool]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs->asBool();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_filter_bool_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsFilterBool ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->asFilterBool();

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsFilterBool]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs->asFilterBool();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_class_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsClass ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->asClass(self::class);

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsClass]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs->asClass(self::class);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_float_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsFloat ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->asFloat();

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsFloat]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs->asFloat();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_int_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsInt ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->asInt();

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsInt]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs->asInt();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_string_can_handle_custom_exceptions(): void
    {
        $rng = $this->faker->sentence();
        $typeAs = NonNullable::make()->type(null);

        $customMessage = 'resolved NULL with AsString ' . $rng;
        $customException = CustomExceptionStub::class;
        $this->expectException($customException);
        $this->expectExceptionMessage($customMessage);

        // throw a custom exception and message with sprintf formatting
        $customErrorFormat = 'resolved %s with %s ' . $rng;
        $typeAs->onError($customErrorFormat, $customException)
            ->asString();

        // it should not persist to the subsequent exception handling
        $defaultMessage = 'Resolution error converting NULL [AsString]';
        $defaultException = TypeAsResolutionException::class;
        $this->expectException($defaultException);
        $this->expectExceptionMessage($defaultMessage);

        $typeAs->asString();
    }
}
