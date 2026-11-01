<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadCastableBoolStub
{
    public function __construct(public mixed $value)
    {
    }

    public function toArray(): bool
    {
        return (bool) $this->value;
    }

    public function toFloat(): bool
    {
        return (bool) $this->value;
    }

    public function toInteger(): bool
    {
        return (bool) $this->value;
    }

    public function toInt(): bool
    {
        return (bool) $this->value;
    }

    public function toString(): bool
    {
        return (bool) $this->value;
    }
}
