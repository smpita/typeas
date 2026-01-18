<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\Strict;
use Smpita\TypeAs\TypeAs;

class FluentTest extends TestCase
{
    protected function tearDown(): void
    {
        TypeAs::useDefaultResolvers();

        parent::tearDown();
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_strict_instance(): void
    {
        $this->assertInstanceOf(Strict::class, TypeAs::from('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_nullable_instance(): void
    {
        $this->assertInstanceOf(Nullable::class, TypeAs::from('test')->nullable());
    }
}
