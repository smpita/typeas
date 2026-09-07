<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadCastableFloatStub
{
    public function __construct(public mixed $value)
    {
    }

    public function toArray(): float
    {
        return (float) $this->value;
    }

    public function toBool(): float
    {
        return (float) $this->value;
    }

    public function toInteger(): float
    {
        return (float) $this->value;
    }

    public function toInt(): float
    {
        return (float) $this->value;
    }

    public function toString(): float
    {
        return (float) $this->value;
    }
}
