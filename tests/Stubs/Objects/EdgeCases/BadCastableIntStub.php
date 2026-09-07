<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadCastableIntStub
{
    public function __construct(public mixed $value)
    {
    }

    public function toArray(): int
    {
        return (int) $this->value;
    }

    public function toBool(): int
    {
        return (int) $this->value;
    }

    public function toFloat(): int
    {
        return (int) $this->value;
    }

    public function toString(): int
    {
        return (int) $this->value;
    }
}
