<?php

namespace Smpita\TypeAs\Tests\Config;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\Definitions\V4;
use Smpita\TypeAs\Config\Definitions\V5;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsArray as LegacyAsArray;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsBool as LegacyAsBool;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsClass as LegacyAsClass;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsFloat as LegacyAsFloat;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsInt as LegacyAsInt;
use Smpita\TypeAs\Resolvers\Legacy\V4\Base\AsString as LegacyAsString;
use Smpita\TypeAs\Resolvers\Legacy\V4\Extensions\AsFilterBool as LegacyAsFilterBool;
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
    public function test_v4_config_returns_resolver_config_with_v4_legacy_resolver_class_names(): void
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

        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Base\AsArray::class, $config->arrayResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Base\AsBool::class, $config->boolResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Base\AsClass::class, $config->classResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Base\AsFloat::class, $config->floatResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Base\AsInt::class, $config->intResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Base\AsString::class, $config->stringResolver());
        $this->assertInstanceOf(\Smpita\TypeAs\Resolvers\Extensions\AsFilterBool::class, $config->filterBoolResolver());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_config_has_correct_legacy_resolver_classes(): void
    {
        $config = ResolverVersion::V4->config();

        $this->assertInstanceOf(LegacyAsArray::class, $config->arrayResolver());
        $this->assertInstanceOf(LegacyAsBool::class, $config->boolResolver());
        $this->assertInstanceOf(LegacyAsClass::class, $config->classResolver());
        $this->assertInstanceOf(LegacyAsFloat::class, $config->floatResolver());
        $this->assertInstanceOf(LegacyAsInt::class, $config->intResolver());
        $this->assertInstanceOf(LegacyAsString::class, $config->stringResolver());
        $this->assertInstanceOf(LegacyAsFilterBool::class, $config->filterBoolResolver());
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
        $this->assertSame(\Smpita\TypeAs\Resolvers\Base\AsArray::class, $config->arrayResolverClass);
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

        $this->assertInstanceOf(BoolResolver::class, $resolver);
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
            \Smpita\TypeAs\Resolvers\Base\AsArray::class,
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
            \Smpita\TypeAs\Resolvers\Base\AsBool::class,
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
            \Smpita\TypeAs\Resolvers\Base\AsClass::class,
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
            \Smpita\TypeAs\Resolvers\Base\AsFloat::class,
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
            \Smpita\TypeAs\Resolvers\Base\AsInt::class,
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
            \Smpita\TypeAs\Resolvers\Base\AsString::class,
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
            \Smpita\TypeAs\Resolvers\Extensions\AsFilterBool::class,
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
    public function test_v4_set_resolvers_returns_config_with_correct_legacy_classes(): void
    {
        $config = ResolverVersion::V4->config();

        $this->assertSame(LegacyAsArray::class, $config->arrayResolverClass);
        $this->assertSame(LegacyAsBool::class, $config->boolResolverClass);
        $this->assertSame(LegacyAsClass::class, $config->classResolverClass);
        $this->assertSame(LegacyAsFloat::class, $config->floatResolverClass);
        $this->assertSame(LegacyAsInt::class, $config->intResolverClass);
        $this->assertSame(LegacyAsString::class, $config->stringResolverClass);
        $this->assertSame(LegacyAsFilterBool::class, $config->filterBoolResolverClass);
    }
}
