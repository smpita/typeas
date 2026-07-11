<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

class FilterBoolStub
{
    public function __invoke(): bool
    {
        return true;
    }

    public function __toBool(): bool
    {
        return true;
    }

    public function toBool(): bool
    {
        return true;
    }
}
