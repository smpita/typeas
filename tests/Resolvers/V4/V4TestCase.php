<?php

namespace Smpita\TypeAs\Tests\Resolvers\V4;

use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\Tests\Testing\Concerns\HandlesFluentBuilder;
use Smpita\TypeAs\TypeAs;

class V4TestCase extends TestCase
{
    use HandlesFluentBuilder;

    protected ResolverVersion $resolverVersion = ResolverVersion::V4;

    protected function setUp(): void
    {
        parent::setUp();

        $this->resolverVersion->setResolvers();
    }

    public function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }
}
