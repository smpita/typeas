<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects\EdgeCases;

class NotCallableStub
{
    protected function __toArray(): array
    {
        return [];
    }

    protected function toArray(): array
    {
        return [];
    }

    protected function __toBool(): bool
    {
        return false;
    }

    protected function toBool(): bool
    {
        return false;
    }

    protected function __toFloat(): float
    {
        return 0.0;
    }

    protected function toFloat(): float
    {
        return 0.0;
    }

    protected function __toInteger(): int
    {
        return 0;
    }

    protected function __toInt(): int
    {
        return 0;
    }

    protected function toInteger(): int
    {
        return 0;
    }

    protected function toInt(): int
    {
        return 0;
    }

    protected function toString(): string
    {
        return '';
    }
}
