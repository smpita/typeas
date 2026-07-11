<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class StringableStub
{
    public function __construct(public string $value)
    {
    }

    public function toString(): string
    {
        return $this->value;
    }
}
