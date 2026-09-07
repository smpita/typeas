<?php

namespace Smpita\TypeAs\Tests\Resolvers\Legacy\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Objects\FilterBoolStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicFilterBoolStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

/**
 * Tests that modify global resolver state run in this isolated class to prevent leaking.
 */
class AsFilterBoolTest extends TestCase
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
    public function test_string_backed_enum_converted_in_v5_where_v4_throws(): void
    {
        $object = StringBackedEnumStub::Empty;

        // V5: fromObject: BackedEnum -> filterBool($value->value)
        $this->assertFalse(TypeAs::filterBool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFilterBoolResolver();

        // V4 has no fromObject — enum goes to filter_var -> null -> throws
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_int_backed_enum_zero_converts_to_false_in_v5_where_v4_throws(): void
    {
        $object = IntBackedEnumStub::Zero;

        // V5 fromObject: BackedEnum -> filterBool($value->value) = filterBool(0) = false
        $this->assertFalse(TypeAs::filterBool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFilterBoolResolver();

        // V4 has no fromObject — enum goes to filter_var -> null -> throws
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_int_backed_enum_one_converts_to_true_in_v5_where_v4_throws(): void
    {
        $object = IntBackedEnumStub::One;

        // V5: fromObject: BackedEnum -> filterBool(1) = true
        $this->assertTrue(TypeAs::filterBool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFilterBoolResolver();

        // V4 has no fromObject — throws
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_object_to_bool_respected_in_v5_where_v4_throws(): void
    {
        $object = new FilterBoolStub(true);

        // V5: fromObject: resolveMethods(__toBool) -> true
        $this->assertTrue(TypeAs::filterBool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFilterBoolResolver();

        // V4 has no fromObject — object goes to filter_var -> null -> throws
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_object_toBool_false_converged_v5_assertions(): void
    {
        $object = new MagicFilterBoolStub(false);

        // V5 resolves __toBool -> false — filter_var(false) = false — no exception
        $this->assertFalse(TypeAs::filterBool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setFilterBoolResolver();

        // V4 has no fromObject — object goes to filter_var -> null -> throws
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::filterBool($object);
    }
}
