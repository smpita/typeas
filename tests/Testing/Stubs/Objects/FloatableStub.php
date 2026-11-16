<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects;

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
