<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadCastableArrayStub
{
    public function __construct(public mixed $value)
    {
    }

    public function toBool(): array
    {
        return (array) $this->value;
    }

    public function toFloat(): array
    {
        return (array) $this->value;
    }

    public function toInteger(): array
    {
        return (array) $this->value;
    }

    public function toInt(): array
    {
        return (array) $this->value;
    }

    public function toString(): array
    {
        return (array) $this->value;
    }
}
