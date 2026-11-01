<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class MagicFilterBoolStub
{
    public function __construct(public bool $value)
    {
    }

    public function __toBool(): bool
    {
        return $this->value;
    }
}
