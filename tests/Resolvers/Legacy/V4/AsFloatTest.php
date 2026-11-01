<?php

namespace Smpita\TypeAs\Tests\Resolvers\Legacy\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\NotCallableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

/**
 * Tests that modify global resolver state run in this isolated class to prevent leaking.
 */
class AsFloatTest extends TestCase
{
    protected ResolverVersion $resolverVersion;

    protected function setUp(): void
    {
        parent::setUp();
        $this->resolverVersion = ResolverVersion::V4;
    }

    public function tearDown(): void
    {
        TypeAs::getInstance()->useDefaultResolvers();
        parent::tearDown();
    }

    /* ------------------------------------------------------------------
     * DIFFERENCE: BackedEnum resolution
     * V5   -> fromObject() checks instanceof BackedEnum -> floatval($enum->value)
     * V4   -> no enum handling -> throws when no default provided (fromObject
     *         returns null, ResolvesFloats wrapper throws on null result)
     * ------------------------------------------------------------------ */

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_string_backing_converted_in_v5_where_v4_throws(): void
    {
        $object = StringBackedEnumStub::OnePointFive;

        // V5: converts StringBackedEnumStub::OnePointFive ('1.5') -> 1.5
        $this->assertSame(1.5, TypeAs::float($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFloatResolver();

        // V4: no enum handling -> throws TypeAsResolutionException (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::float($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_zero_value_converted_in_v5_where_v4_throws(): void
    {
        $object = IntBackedEnumStub::Zero;

        // V5: converts IntBackedEnumStub::Zero (0) -> 0.0
        $this->assertSame(0.0, TypeAs::float($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFloatResolver();

        // V4: no enum handling -> throws TypeAsResolutionException (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::float($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_string_backing_returns_default_in_v4(): void
    {
        $object = StringBackedEnumStub::OnePointFive;
        $default = 99.0;

        // V5: converts '1.5' -> 1.5, never uses default
        $this->assertSame(1.5, TypeAs::float($object, default: $default));

        // Switch to V4 resolvers
        $this->resolverVersion->setFloatResolver();

        // V4: enum has no __toFloat/toFloat -> fromObject returns null -> uses default
        $this->assertSame(99.0, TypeAs::float($object, default: $default));
    }

    /* ------------------------------------------------------------------
     * DIFFERENCE: Method callable validation via ResolvesMethods trait
     * V5   -> resolveMethod() checks method_exists AND is_callable -> skips protected
     *         methods, returns null -> uses default (or throws if no default)
     * V4   -> only checks method_exists -> attempts call, throws Error on protected
     * ------------------------------------------------------------------ */

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_protected_to_float_method_ignored_in_v5_where_v4_throws_error(): void
    {
        $object = new NotCallableStub();

        // V5: ResolvesMethods trait skips protected methods (is_callable fails)
        //     -> resolve returns null -> throws TypeAsResolutionException (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::float($object);

        // Switch to V4 resolvers
        $this->resolverVersion->setFloatResolver();

        // V4: method_exists passes for protected -> attempts call -> throws Error
        $this->expectException(\Error::class);
        TypeAs::float($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_protected_to_float_uses_default_in_v5_where_v4_still_errors(): void
    {
        $object = new NotCallableStub();
        $default = 99.0;

        // V5: with default, protected methods skipped -> returns default (99.0)
        $this->assertSame(99.0, TypeAs::float($object, default: $default));

        // Switch to V4 resolvers
        $this->resolverVersion->setFloatResolver();

        // V4: protected method exists but not callable -> Error regardless of default
        $this->expectException(\Error::class);
        TypeAs::float($object, default: $default);
    }
}
