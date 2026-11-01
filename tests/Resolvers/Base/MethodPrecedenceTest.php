<?php

namespace Smpita\TypeAs\Tests\Resolvers\Base;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Smpita\TypeAs\Tests\Stubs\Objects\MultiStub;
use Smpita\TypeAs\Tests\TestCase;
use Smpita\TypeAs\TypeAs;

class MethodPrecedenceTest extends TestCase
{
    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_array_prefers_magic_over_nonmagic(): void
    {
        // Both __toArray and toArray exist; magic __toArray should win (first-match)
        $this->assertSame(['magic'], TypeAs::array(new MultiStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_array_falls_through_to_nonmagic_when_magic_missing(): void
    {
        $stub = new class () {
            public function toArray(): array
            {
                return ['fallback'];
            }
        };

        $this->assertSame(['fallback'], TypeAs::array($stub));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_bool_prefers_magic_over_nonmagic(): void
    {
        // Both __toBool and toBool exist; magic __toBool should win (first-match)
        $this->assertTrue(TypeAs::bool(new MultiStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_bool_falls_through_to_nonmagic_when_magic_missing(): void
    {
        $stub = new class () {
            public function toBool(): bool
            {
                return true;
            }
        };

        $this->assertTrue(TypeAs::bool($stub));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_int_prefers_magic_over_nonmagic(): void
    {
        // Both __toInt and toInt exist; magic __toInt should win (first-match)
        $this->assertSame(1, TypeAs::int(new MultiStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_int_falls_through_to_nonmagic_when_magic_missing(): void
    {
        $stub = new class () {
            public function toInt(): int
            {
                return 42;
            }
        };

        $this->assertSame(42, TypeAs::int($stub));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_float_prefers_magic_over_nonmagic(): void
    {
        // Both __toFloat and toFloat exist; magic __toFloat should win (first-match)
        $this->assertSame(1.0, TypeAs::float(new MultiStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_float_falls_through_to_nonmagic_when_magic_missing(): void
    {
        $stub = new class () {
            public function toFloat(): float
            {
                return 1.5;
            }
        };

        $this->assertSame(1.5, TypeAs::float($stub));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_string_prefers_magic_over_nonmagic(): void
    {
        // Both __toString and toString exist; magic __toString should win (first-match)
        $this->assertSame('magic', TypeAs::string(new MultiStub()));
    }

    #[Test]
    #[Group('smpita')]
    #[Group('typeas')]
    public function test_as_string_falls_through_to_nonmagic_when_magic_missing(): void
    {
        $stub = new class () {
            public function toString(): string
            {
                return 'fallback';
            }
        };

        $this->assertSame('fallback', TypeAs::string($stub));
    }
}
