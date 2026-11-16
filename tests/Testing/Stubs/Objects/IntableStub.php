<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects;

class IntableStub
{
    public function __construct(public int $value)
    {
    }

    public function toInt(): int
    {
        return $this->value;
    }
}
