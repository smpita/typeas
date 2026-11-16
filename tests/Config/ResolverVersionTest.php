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
use Smpita\TypeAs\Contracts\FilterBoolResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Resolvers\V4\AsArray as V4AsArray;
use Smpita\TypeAs\Resolvers\V4\AsBool as V4AsBool;
use Smpita\TypeAs\Resolvers\V4\AsClass as V4AsClass;
use Smpita\TypeAs\Resolvers\V4\AsFilterBool as V4AsFilterBool;
use Smpita\TypeAs\Resolvers\V4\AsFloat as V4AsFloat;
use Smpita\TypeAs\Resolvers\V4\AsInt as V4AsInt;
use Smpita\TypeAs\Resolvers\V4\AsString as V4AsString;
use Smpita\TypeAs\Resolvers\V5\AsArray as V5AsArray;
use Smpita\TypeAs\Resolvers\V5\AsBool as V5AsBool;
use Smpita\TypeAs\Resolvers\V5\AsClass as V5AsClass;
use Smpita\TypeAs\Resolvers\V5\AsFilterBool as V5AsFilterBool;
use Smpita\TypeAs\Resolvers\V5\AsFloat as V5AsFloat;
use Smpita\TypeAs\Resolvers\V5\AsInt as V5AsInt;
use Smpita\TypeAs\Resolvers\V5\AsString as V5AsString;
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
    public function test_enum_cases_have_correct_string_values(): void
    {
        $this->assertSame(V5::class, ResolverVersion::V5->value);
        $this->assertSame(V4::class, ResolverVersion::V4->value);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_each_config_returns_resolver_config(): void
    {
        foreach (ResolverVersion::cases() as $case) {
            $this->assertInstanceOf(ResolverConfig::class, $case->config());
        }
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v5_config_has_correct_resolver_classes(): void
    {
        $config = ResolverVersion::V5->config();

        $arrayResolver = $config->arrayResolver();
        $this->assertInstanceOf(ArrayResolver::class, $arrayResolver);
        $this->assertInstanceOf(V5AsArray::class, $arrayResolver);

        $boolResolver = $config->boolResolver();
        $this->assertInstanceOf(BoolResolver::class, $boolResolver);
        $this->assertInstanceOf(V5AsBool::class, $boolResolver);

        $classResolver = $config->classResolver();
        $this->assertInstanceOf(ClassResolver::class, $classResolver);
        $this->assertInstanceOf(V5AsClass::class, $classResolver);

        $filterBoolResolver = $config->filterBoolResolver();
        $this->assertInstanceOf(FilterBoolResolver::class, $filterBoolResolver);
        $this->assertInstanceOf(V5AsFilterBool::class, $filterBoolResolver);

        $floatResolver = $config->floatResolver();
        $this->assertInstanceOf(FloatResolver::class, $floatResolver);
        $this->assertInstanceOf(V5AsFloat::class, $floatResolver);

        $intResolver = $config->intResolver();
        $this->assertInstanceOf(IntResolver::class, $intResolver);
        $this->assertInstanceOf(V5AsInt::class, $intResolver);

        $stringResolver = $config->stringResolver();
        $this->assertInstanceOf(StringResolver::class, $stringResolver);
        $this->assertInstanceOf(V5AsString::class, $stringResolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_config_has_correct_resolver_classes(): void
    {
        $config = ResolverVersion::V4->config();

        $arrayResolver = $config->arrayResolver();
        $this->assertInstanceOf(ArrayResolver::class, $arrayResolver);
        $this->assertInstanceOf(V4AsArray::class, $arrayResolver);

        $boolResolver = $config->boolResolver();
        $this->assertInstanceOf(BoolResolver::class, $boolResolver);
        $this->assertInstanceOf(V4AsBool::class, $boolResolver);

        $classResolver = $config->classResolver();
        $this->assertInstanceOf(ClassResolver::class, $classResolver);
        $this->assertInstanceOf(V4AsClass::class, $classResolver);

        $filterBoolResolver = $config->filterBoolResolver();
        $this->assertInstanceOf(FilterBoolResolver::class, $filterBoolResolver);
        $this->assertInstanceOf(V4AsFilterBool::class, $filterBoolResolver);

        $floatResolver = $config->floatResolver();
        $this->assertInstanceOf(FloatResolver::class, $floatResolver);
        $this->assertInstanceOf(V4AsFloat::class, $floatResolver);

        $intResolver = $config->intResolver();
        $this->assertInstanceOf(IntResolver::class, $intResolver);
        $this->assertInstanceOf(V4AsInt::class, $intResolver);

        $stringResolver = $config->stringResolver();
        $this->assertInstanceOf(StringResolver::class, $stringResolver);
        $this->assertInstanceOf(V4AsString::class, $stringResolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_v4_and_v5_have_independent_resolvers(): void
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
            $v5Config->filterBoolResolverClass,
            $v4Config->filterBoolResolverClass,
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
    }
}
