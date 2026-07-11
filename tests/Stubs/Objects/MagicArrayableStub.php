<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicArrayableStub
{
    public function __construct(public array $value)
    {
    }

    public function __toArray(): array
    {
        return $this->value;
    }
}
