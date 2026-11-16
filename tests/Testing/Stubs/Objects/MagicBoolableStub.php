<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects;

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
