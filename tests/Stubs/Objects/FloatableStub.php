<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class FloatableStub
{
    public function __construct(public float $value)
    {
    }

    public function toFloat(): float
    {
        return $this->value;
    }
}
