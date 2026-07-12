<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicFloatableStub
{
    public function __construct(public float $value)
    {
    }

    public function __toFloat(): float
    {
        return $this->value;
    }
}
