<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects\EdgeCases;

class BadMagicCastableBoolStub
{
    public function __construct(public mixed $value)
    {
    }

    public function __toArray(): bool
    {
        return (bool) $this->value;
    }

    public function __toFloat(): bool
    {
        return (bool) $this->value;
    }

    public function __toInteger(): bool
    {
        return (bool) $this->value;
    }

    public function __toInt(): bool
    {
        return (bool) $this->value;
    }
}
