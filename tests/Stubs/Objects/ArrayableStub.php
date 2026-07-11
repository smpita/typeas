<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class ArrayableStub
{
    public function __construct(public array $value)
    {
    }

    public function toArray(): array
    {
        return $this->value;
    }
}
