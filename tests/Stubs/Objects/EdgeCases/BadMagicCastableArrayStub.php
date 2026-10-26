<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadMagicCastableArrayStub
{
    public function __construct(public mixed $value)
    {
    }

    public function __toBool(): array
    {
        return (array) $this->value;
    }

    public function __toFloat(): array
    {
        return (array) $this->value;
    }

    public function __toInteger(): array
    {
        return (array) $this->value;
    }

    public function __toInt(): array
    {
        return (array) $this->value;
    }
}
