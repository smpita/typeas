<?php

namespace Smpita\TypeAs\Tests;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Fluent\Nullable;
use Smpita\TypeAs\Fluent\NonNullable;
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
    public function test_can_create_a_non_nullable_instance(): void
    {
        $this->assertInstanceOf(NonNullable::class, TypeAs::type('test'));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_nullable_instance(): void
    {
        $this->assertInstanceOf(Nullable::class, TypeAs::type('test')->nullable());
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_can_create_a_non_nullable_instance_from_a_nullable_instance(): void
    {
        $this->assertInstanceOf(NonNullable::class, TypeAs::type('test')->nullable()->nonNullable());
    }
}
