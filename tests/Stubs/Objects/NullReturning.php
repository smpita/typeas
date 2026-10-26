<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

/**
 * Object whose methods explicitly return null.
 * Tests that resolveMethods does not skip a callable method just because it returns null.
 */
class NullReturning
{
    public function first(): ?string
    {
        return null;
    }

    public function second(): ?string
    {
        return null;
    }
}
