<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class FilterBoolStub
{
    public function __construct(public bool $value)
    {
    }

    public function toBool(): bool
    {
        return $this->value;
    }
}
