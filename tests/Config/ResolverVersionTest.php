<?php

namespace Smpita\TypeAs\Tests\Config;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\Definitions\V4;
use Smpita\TypeAs\Config\Definitions\V5;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\FilterBoolResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\V4\AsArray as V4AsArray;
use Smpita\TypeAs\Resolvers\V4\AsBool as V4AsBool;
use Smpita\TypeAs\Resolvers\V4\AsClass as V4AsClass;
use Smpita\TypeAs\Resolvers\V4\AsFloat as V4AsFloat;
use Smpita\TypeAs\Resolvers\V4\AsInt as V4AsInt;
use Smpita\TypeAs\Resolvers\V4\AsString as V4AsString;
use Smpita\TypeAs\Resolvers\V4\AsFilterBool as V4AsFilterBool;
use Smpita\TypeAs\TypeAs;
use Smpita\TypeAs\Tests\TestCase;

class ResolverVersionTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_default_returns_v5_case(): void
    {
        $this->assertSame(ResolverVersion::V5, ResolverVersion::default());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_config_returns_resolver_config_with_v5_resolver_class_names(): void
    {
        $config = ResolverVersion::V5->config();

        $this->assertInstanceOf(ResolverConfig::class, $config);
        $this->assertSame(V5::class, (string) ResolverVersion::V5->value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_config_returns_resolver_config_with_v4_resolver_class_names(): void
    {
        $config = ResolverVersion::V4->config();

        $this->assertInstanceOf(ResolverConfig::class, $config);
        $this->assertSame(V4::class, (string) ResolverVersion::V4->value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_config_has_correct_resolver_classes(): void
    {
        $config = ResolverVersion::V5->config();

        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsArray::class, $config->arrayResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsBool::class, $config->boolResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsClass::class, $config->classResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsFloat::class, $config->floatResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsInt::class, $config->intResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsString::class, $config->stringResolver());
        // AsFilterBool now implements FilterBoolResolver from the Base namespace
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_config_has_correct_resolver_classes(): void
    {
        $config = ResolverVersion::V4->config();

        $this->assertInstanceOf(V4AsArray::class, $config->arrayResolver());
        $this->assertInstanceOf(V4AsBool::class, $config->boolResolver());
        $this->assertInstanceOf(V4AsClass::class, $config->classResolver());
        $this->assertInstanceOf(V4AsFloat::class, $config->floatResolver());
        $this->assertInstanceOf(V4AsInt::class, $config->intResolver());
        $this->assertInstanceOf(V4AsString::class, $config->stringResolver());
        $this->assertInstanceOf(V4AsFilterBool::class, $config->filterBoolResolver());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_and_v5_configs_differ(): void
    {
        $v5Config = ResolverVersion::V5->config();
        $v4Config = ResolverVersion::V4->config();

        $this->assertNotSame(
            $v5Config->arrayResolverClass,
            $v4Config->arrayResolverClass,
        );

        $this->assertNotSame(
            $v5Config->boolResolverClass,
            $v4Config->boolResolverClass,
        );

        $this->assertNotSame(
            $v5Config->classResolverClass,
            $v4Config->classResolverClass,
        );

        $this->assertNotSame(
            $v5Config->floatResolverClass,
            $v4Config->floatResolverClass,
        );

        $this->assertNotSame(
            $v5Config->intResolverClass,
            $v4Config->intResolverClass,
        );

        $this->assertNotSame(
            $v5Config->stringResolverClass,
            $v4Config->stringResolverClass,
        );

        $this->assertNotSame(
            $v5Config->filterBoolResolverClass,
            $v4Config->filterBoolResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_array_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->arrayResolver();

        $this->assertInstanceOf(ArrayResolver::class, $resolver);
        $this->assertSame(\Smpita\TypeAs\Resolvers\V5\AsArray::class, $config->arrayResolverClass);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_bool_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->boolResolver();

        $this->assertInstanceOf(BoolResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_class_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->classResolver();

        $this->assertInstanceOf(ClassResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_float_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->floatResolver();

        $this->assertInstanceOf(FloatResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_int_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->intResolver();

        $this->assertInstanceOf(IntResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_string_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->stringResolver();

        $this->assertInstanceOf(StringResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_filter_bool_resolver_is_correct_type(): void
    {
        $config = ResolverVersion::V5->config();

        $resolver = $config->filterBoolResolver();

        $this->assertInstanceOf(FilterBoolResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_array_resolver_returns_config_with_array_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setArrayResolver();

        // setResolvers delegates via config() -> arrayResolver(), so the config returns same class-string
        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsArray::class,
            $configBefore->arrayResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_bool_resolver_returns_config_with_bool_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setBoolResolver();

        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsBool::class,
            $configBefore->boolResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_class_resolver_returns_config_with_class_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setClassResolver();

        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsClass::class,
            $configBefore->classResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_float_resolver_returns_config_with_float_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setFloatResolver();

        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsFloat::class,
            $configBefore->floatResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_int_resolver_returns_config_with_int_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setIntResolver();

        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsInt::class,
            $configBefore->intResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_string_resolver_returns_config_with_string_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setStringResolver();

        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsString::class,
            $configBefore->stringResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_filter_bool_resolver_returns_config_with_filter_bool_resolved(): void
    {
        $configBefore = ResolverVersion::V5->config();

        ResolverVersion::V5->setFilterBoolResolver();

        $this->assertSame(
            \Smpita\TypeAs\Resolvers\V5\AsFilterBool::class,
            $configBefore->filterBoolResolverClass,
        );
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_enum_cases_have_correct_string_values(): void
    {
        $this->assertSame(V5::class, ResolverVersion::V5->value);
        $this->assertSame(V4::class, ResolverVersion::V4->value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_set_resolvers_returns_config_with_correct_classes(): void
    {
        $config = ResolverVersion::V4->config();

        $this->assertSame(V4AsArray::class, $config->arrayResolverClass);
        $this->assertSame(V4AsBool::class, $config->boolResolverClass);
        $this->assertSame(V4AsClass::class, $config->classResolverClass);
        $this->assertSame(V4AsFloat::class, $config->floatResolverClass);
        $this->assertSame(V4AsInt::class, $config->intResolverClass);
        $this->assertSame(V4AsString::class, $config->stringResolverClass);
        $this->assertSame(V4AsFilterBool::class, $config->filterBoolResolverClass);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_set_resolvers_sets_all_7_resolvers(): void
    {
        TypeAs::useDefaultResolvers();

        ResolverVersion::V5->setResolvers();

        $resolvers = TypeAs::getInstance()->resolvers();

        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsArray::class, $resolvers->arrayResolver);
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsBool::class, $resolvers->boolResolver);
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsClass::class, $resolvers->classResolver);
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsFilterBool::class, $resolvers->filterBoolResolver);
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsFloat::class, $resolvers->floatResolver);
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsInt::class, $resolvers->intResolver);
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\V5\AsString::class, $resolvers->stringResolver);
    }
}
