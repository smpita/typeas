<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicIntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function __toInteger(): int
    {
        return $this->value;
    }
}
