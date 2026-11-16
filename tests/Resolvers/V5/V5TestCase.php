<?php

namespace Smpita\TypeAs\Tests\Resolvers\V5;

use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\Tests\Testing\Concerns\HandlesFluentBuilder;
use Smpita\TypeAs\TypeAs;

class V5TestCase extends TestCase
{
    use HandlesFluentBuilder;

    protected ResolverVersion $resolverVersion = ResolverVersion::V5;

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
