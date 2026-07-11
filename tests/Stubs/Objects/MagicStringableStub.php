<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicStringableStub
{
    public function __construct(public string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
