<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects;

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
