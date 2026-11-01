<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

/**
 * Object with mixed visibility: first() private, second() public.
 * Tests that ResolvesMethods skips non-callable methods and continues to callable ones.
 */
class MethodObjectStubWithNonCallableFirst
{
    private function first(): string
    {
        return 'first';
    }

    public function second(): string
    {
        return 'second';
    }
}
