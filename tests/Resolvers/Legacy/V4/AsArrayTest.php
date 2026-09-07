<?php

namespace Smpita\TypeAs\Tests\Resolvers\Legacy\V4;

use Error;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases\NotCallableStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class AsArrayTest extends TestCase
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
    public function test_v5_skips_protected_to_array_where_v4_crashes(): void
    {
        $obj = new NotCallableStub();

        // V5: is_callable fails on protected -> skips method -> wraps value in [obj]
        $this->assertSame([$obj], TypeAs::array($obj));

        // Switch to V4 resolvers
        $this->resolverVersion->setArrayResolver();

        // V4: method_exists true -> calls protected -> throws Error
        $this->expectException(Error::class);
        TypeAs::array($obj);
    }
}
