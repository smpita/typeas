<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class IntegerableStub
{
    public function __construct(public int $value)
    {
    }

    public function toInteger(): int
    {
        return $this->value;
    }
}
