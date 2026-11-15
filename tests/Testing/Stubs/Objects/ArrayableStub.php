<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects;

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
