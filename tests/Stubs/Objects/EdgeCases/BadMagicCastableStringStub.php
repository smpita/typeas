<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadMagicCastableStringStub
{
    public function __construct(public mixed $value)
    {
    }

    public function __toArray(): string
    {
        return (string) $this->value;
    }

    public function __toBool(): string
    {
        return (string) $this->value;
    }

    public function __toFloat(): string
    {
        return (string) $this->value;
    }

    public function __toInteger(): string
    {
        return (string) $this->value;
    }

    public function __toInt(): string
    {
        return (string) $this->value;
    }
}
