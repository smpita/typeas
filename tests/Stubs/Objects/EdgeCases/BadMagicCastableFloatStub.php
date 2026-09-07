<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadMagicCastableFloatStub
{
    public function __construct(public mixed $value)
    {
    }

    public function __toArray(): float
    {
        return (float) $this->value;
    }

    public function __toBool(): float
    {
        return (float) $this->value;
    }

    public function __toInteger(): float
    {
        return (float) $this->value;
    }

    public function __toInt(): float
    {
        return (float) $this->value;
    }
}
