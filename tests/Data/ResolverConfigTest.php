<?php

namespace Smpita\TypeAs\Tests\Data;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FilterBoolResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\Tests\TestCase;

class ResolverConfigTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_config_properties_have_correct_interfaces(): void
    {
        $config = $this->config();

        $this->assertClassStringImplements(ArrayResolver::class, $config->arrayResolverClass);
        $this->assertClassStringImplements(BoolResolver::class, $config->boolResolverClass);
        $this->assertClassStringImplements(ClassResolver::class, $config->classResolverClass);
        $this->assertClassStringImplements(FilterBoolResolver::class, $config->filterBoolResolverClass);
        $this->assertClassStringImplements(FloatResolver::class, $config->floatResolverClass);
        $this->assertClassStringImplements(IntResolver::class, $config->intResolverClass);
        $this->assertClassStringImplements(StringResolver::class, $config->stringResolverClass);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_arrayResolver_returns_new_array_resolver_instance(): void
    {
        $resolver = $this->config()->arrayResolver();

        $this->assertInstanceOf(ArrayResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_boolResolver_returns_new_bool_resolver_instance(): void
    {
        $resolver = $this->config()->boolResolver();

        $this->assertInstanceOf(BoolResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_classResolver_returns_new_class_resolver_instance(): void
    {
        $resolver = $this->config()->classResolver();

        $this->assertInstanceOf(ClassResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_filterBoolResolver_returns_new_bool_resolver_instance(): void
    {
        $resolver = $this->config()->filterBoolResolver();

        $this->assertInstanceOf(FilterBoolResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_floatResolver_returns_new_float_resolver_instance(): void
    {
        $resolver = $this->config()->floatResolver();

        $this->assertInstanceOf(FloatResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_intResolver_returns_new_int_resolver_instance(): void
    {
        $resolver = $this->config()->intResolver();

        $this->assertInstanceOf(IntResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_stringResolver_returns_new_string_resolver_instance(): void
    {
        $resolver = $this->config()->stringResolver();

        $this->assertInstanceOf(StringResolver::class, $resolver);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_same_factory_returns_distinct_instances(): void
    {
        $config = $this->config();

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

    private function config(): ResolverConfig
    {
        return ResolverVersion::default()->config();
    }

    /**
     * @template T of object
     * @param class-string<T> $expected
     * @phpstan-assert class-string<T> $actual
     */
    protected function assertClassStringImplements(string $expected, mixed $actual, string $message = ''): void
    {
        $this->assertIsString($actual, $message);

        $this->assertTrue(
            class_exists($actual),
            $message ?: "Failed asserting that '$actual' is an existing class."
        );

        $this->assertTrue(
            is_a($actual, $expected, true),
            $message ?: "Failed asserting that '$actual' implements '$expected'."
        );
    }
}
