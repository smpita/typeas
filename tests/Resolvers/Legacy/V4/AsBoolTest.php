<?php

namespace Smpita\TypeAs\Tests\Resolvers\Legacy\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Objects\BoolableStub;
use Smpita\TypeAs\Tests\Stubs\Objects\MagicBoolableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

/**
 * Tests that modify global resolver state run in this isolated class to prevent leaking.
 */
class AsBoolTest extends TestCase
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
    public function test_backed_enum_int_value_converted_in_v5_where_v4_ignores(): void
    {
        $object = IntBackedEnumStub::Zero;

        // V5: converts enum backing value (0 -> false)
        $this->assertFalse(TypeAs::bool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setBoolResolver();

        // V4: boolval(object) always true, ignores backing value
        $this->assertTrue(TypeAs::bool($object));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_backed_enum_string_value_converted_in_v5_where_v4_ignores(): void
    {
        $object = StringBackedEnumStub::Empty;

        // V5: converts enum backing value ('' -> false)
        $this->assertFalse(TypeAs::bool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setBoolResolver();

        // V4: boolval(object) always true
        $this->assertTrue(TypeAs::bool($object));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_object_toBool_method_respected_in_v5_where_v4_ignores(): void
    {
        $object = new BoolableStub(false);

        // V5: calls toBool() on BoolableStub -> false
        $this->assertFalse(TypeAs::bool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setBoolResolver();

        // V4: direct boolval(object) -> true, ignores __toBool()
        $this->assertTrue(TypeAs::bool($object));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_object_magic_toBool_method_respected_in_v5_where_v4_ignores(): void
    {
        $object = new MagicBoolableStub(false);

        // V5: calls __toBool() directly -> respects return value
        $this->assertFalse(TypeAs::bool($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setBoolResolver();

        // V4: direct boolval(object) -> true, ignores magic __toBool()
        $this->assertTrue(TypeAs::bool($object));
    }
}
