<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class BadCastableStringStub
{
    public function __construct(public mixed $value)
    {
    }

    public function toArray(): string
    {
        return (string) $this->value;
    }

    public function toBool(): string
    {
        return (string) $this->value;
    }

    public function toFloat(): string
    {
        return (string) $this->value;
    }

    public function toInteger(): string
    {
        return (string) $this->value;
    }

    public function toInt(): string
    {
        return (string) $this->value;
    }
}
