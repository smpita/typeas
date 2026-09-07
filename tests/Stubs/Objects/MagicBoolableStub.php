<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicBoolableStub
{
    public function __construct(public bool $value)
    {
    }

    public function __toBool(): bool
    {
        return $this->value;
    }
}
