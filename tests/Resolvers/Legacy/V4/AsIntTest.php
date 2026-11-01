<?php

namespace Smpita\TypeAs\Tests\Resolvers\Legacy\V4;

use Error;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Objects\IntableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicIntableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\NotCallableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsIntTest extends TestCase
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

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_string_value_returns_default_in_v4(): void
    {
        $object = StringBackedEnumStub::OnePointFive;
        $default = 99;

        // V5: converts '1.5' -> 1, default never used
        $this->assertSame(1, TypeAs::int($object, default: $default));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: no enum handling -> null -> uses default
        $this->assertSame(99, TypeAs::int($object, default: $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_int_value_converts_in_v5_where_v4_ignores(): void
    {
        $object = IntBackedEnumStub::One;

        // V5: converts IntBackedEnumStub::One (1) -> 1
        $this->assertSame(1, TypeAs::int($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: no enum handling -> throws TypeAsResolutionException (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::int($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_string_value_converts_in_v5_where_v4_ignores(): void
    {
        $object = StringBackedEnumStub::OnePointFive;

        // V5: converts StringBackedEnumStub::OnePointFive ('1.5') -> 1 (intval truncates)
        $this->assertSame(1, TypeAs::int($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: no enum handling -> throws (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::int($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_to_int_method_resolved_in_v5_not_v4(): void
    {
        $object = new IntableStub(42);

        // V5: resolves IntableStub (toInt() -> 42)
        $this->assertSame(42, TypeAs::int($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: no toInt support -> fromObject returns null -> throws (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::int($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_magic_to_int_method_resolved_in_v5_not_v4(): void
    {
        $object = new MagicIntableStub(50);

        // V5: resolves MagicIntableStub (__toInt() -> 50)
        $this->assertSame(50, TypeAs::int($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: no __toInt support -> null -> throws (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::int($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_to_int_returns_default_in_v4(): void
    {
        $object = new IntableStub(42);
        $default = 99;

        // V5: resolves toInt() -> 42, default never used
        $this->assertSame(42, TypeAs::int($object, default: $default));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: no toInt -> null -> uses default
        $this->assertSame(99, TypeAs::int($object, default: $default));
    }

    /* ------------------------------------------------------------------
     * DIFFERENCE: is_callable gate on methods
     * V5   -> resolveMethod() checks method_exists AND is_callable -> skips protected
     * V4   -> only checks method_exists -> attempts call, throws Error on protected
     * ------------------------------------------------------------------ */

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_protected_conversion_method_skipped_in_v5_where_v4_throws_error(): void
    {
        $object = new NotCallableStub();

        // V5: ResolvesMethods trait skips protected methods -> null -> throws (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::int($object);

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: method_exists passes for protected -> attempts call -> throws Error
        $this->expectException(Error::class);
        TypeAs::int($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_protected_method_uses_default_in_v5_where_v4_still_errors(): void
    {
        $object = new NotCallableStub();
        $default = 99;

        // V5: with default -> protected skipped -> returns default (99)
        $this->assertSame(99, TypeAs::int($object, default: $default));

        // Switch to V4 resolvers
        $this->resolverVersion->setIntResolver();

        // V4: protected exists -> attempts call -> Error regardless of default
        $this->expectException(Error::class);
        TypeAs::int($object, default: $default);
    }
}
