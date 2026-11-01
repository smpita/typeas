<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadMagicCastableIntStub
{
    public function __construct(public mixed $value)
    {
    }

    public function __toArray(): int
    {
        return (int) $this->value;
    }

    public function __toBool(): int
    {
        return (int) $this->value;
    }

    public function __toFloat(): int
    {
        return (int) $this->value;
    }
}
