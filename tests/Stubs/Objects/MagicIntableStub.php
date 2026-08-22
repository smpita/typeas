<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicIntableStub
{
    public function __construct(public int $value)
    {
    }

    public function __toInt(): int
    {
        return $this->value;
    }
}
