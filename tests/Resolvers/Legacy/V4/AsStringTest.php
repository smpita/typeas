<?php

namespace Smpita\TypeAs\Tests\Resolvers\Legacy\V4;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Tests\Stubs\Enums\IntBackedEnumStub;
use Smpita\TypeAs\Tests\Stubs\Enums\StringBackedEnumStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsStringTest extends TestCase
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
    public function test_string_backed_enum_returns_default_in_v4(): void
    {
        $object = StringBackedEnumStub::OnePointFive;
        $default = 'fallback';

        // V5: converts '1.5' -> '1.5', default never used
        $this->assertSame('1.5', TypeAs::string($object, default: $default));

        // Switch to V4 resolvers
        $this->resolverVersion->setStringResolver();

        // V4: no enum handling -> null -> uses default
        $this->assertSame('fallback', TypeAs::string($object, default: $default));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_string_backed_enum_converted_in_v5_where_v4_throws(): void
    {
        $object = StringBackedEnumStub::OnePointFive;

        // V5: converts StringBackedEnumStub::OnePointFive ('1.5') -> '1.5'
        $this->assertSame('1.5', TypeAs::string($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setStringResolver();

        // V4: no enum __toString -> throws TypeAsResolutionException (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::string($object);
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    #[Group('legacy')]
    public function test_int_backed_enum_converted_in_v5_where_v4_throws(): void
    {
        $object = IntBackedEnumStub::One;

        // V5: converts IntBackedEnumStub::One (1) -> '1'
        $this->assertSame('1', TypeAs::string($object));

        // Switch to V4 resolvers
        $this->resolverVersion->setStringResolver();

        // V4: no enum __toString -> throws (no default)
        $this->expectException(TypeAsResolutionException::class);
        TypeAs::string($object);
    }
}
