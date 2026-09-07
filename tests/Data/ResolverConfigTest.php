<?php

namespace Smpita\TypeAs\Tests\Data;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\Base\AsArray;
use Smpita\TypeAs\Resolvers\Base\AsBool;
use Smpita\TypeAs\Resolvers\Base\AsClass;
use Smpita\TypeAs\Resolvers\Base\AsFloat;
use Smpita\TypeAs\Resolvers\Base\AsInt;
use Smpita\TypeAs\Resolvers\Base\AsString;
use Smpita\TypeAs\Resolvers\Extensions\AsFilterBool;
use Smpita\TypeAs\Tests\TestCase;

class ResolverConfigTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_constructor_accepts_all_resolver_class_strings(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $this->assertSame(AsArray::class, $config->arrayResolverClass);
        $this->assertSame(AsBool::class, $config->boolResolverClass);
        $this->assertSame(AsClass::class, $config->classResolverClass);
        $this->assertSame(AsFloat::class, $config->floatResolverClass);
        $this->assertSame(AsInt::class, $config->intResolverClass);
        $this->assertSame(AsString::class, $config->stringResolverClass);
        $this->assertSame(AsFilterBool::class, $config->filterBoolResolverClass);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_arrayResolver_returns_new_array_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->arrayResolver();

        $this->assertInstanceOf(ArrayResolver::class, $resolver);
        $this->assertInstanceOf(AsArray::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_boolResolver_returns_new_bool_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->boolResolver();

        $this->assertInstanceOf(BoolResolver::class, $resolver);
        $this->assertInstanceOf(AsBool::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_classResolver_returns_new_class_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->classResolver();

        $this->assertInstanceOf(ClassResolver::class, $resolver);
        $this->assertInstanceOf(AsClass::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_floatResolver_returns_new_float_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->floatResolver();

        $this->assertInstanceOf(FloatResolver::class, $resolver);
        $this->assertInstanceOf(AsFloat::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_intResolver_returns_new_int_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->intResolver();

        $this->assertInstanceOf(IntResolver::class, $resolver);
        $this->assertInstanceOf(AsInt::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_stringResolver_returns_new_string_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->stringResolver();

        $this->assertInstanceOf(StringResolver::class, $resolver);
        $this->assertInstanceOf(AsString::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_filterBoolResolver_returns_new_bool_resolver_instance(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $resolver = $config->filterBoolResolver();

        $this->assertInstanceOf(BoolResolver::class, $resolver);
        $this->assertInstanceOf(AsFilterBool::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_same_factory_returns_distinct_instances(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $this->assertNotSame(
            $config->arrayResolver(),
            $config->arrayResolver(),
        );

        $this->assertNotSame(
            $config->boolResolver(),
            $config->boolResolver(),
        );

        $this->assertNotSame(
            $config->classResolver(),
            $config->classResolver(),
        );

        $this->assertNotSame(
            $config->floatResolver(),
            $config->floatResolver(),
        );

        $this->assertNotSame(
            $config->intResolver(),
            $config->intResolver(),
        );

        $this->assertNotSame(
            $config->stringResolver(),
            $config->stringResolver(),
        );

        $this->assertNotSame(
            $config->filterBoolResolver(),
            $config->filterBoolResolver(),
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_property_accessors_return_original_class_strings(): void
    {
        $config = new ResolverConfig(
            arrayResolverClass: AsArray::class,
            boolResolverClass: AsBool::class,
            classResolverClass: AsClass::class,
            floatResolverClass: AsFloat::class,
            intResolverClass: AsInt::class,
            stringResolverClass: AsString::class,
            filterBoolResolverClass: AsFilterBool::class,
        );

        $this->assertSame(AsArray::class, $config->arrayResolverClass);
        $this->assertSame(AsBool::class, $config->boolResolverClass);
        $this->assertSame(AsClass::class, $config->classResolverClass);
        $this->assertSame(AsFloat::class, $config->floatResolverClass);
        $this->assertSame(AsInt::class, $config->intResolverClass);
        $this->assertSame(AsString::class, $config->stringResolverClass);
        $this->assertSame(AsFilterBool::class, $config->filterBoolResolverClass);
    }
}
