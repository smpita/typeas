<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

/**
 * Object with only second() method. first() does not exist.
 * Tests that resolveMethods skips nonexistent methods.
 */
class OnlySecond
{
    public function second(): string
    {
        return 'second';
    }
}
