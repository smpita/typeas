<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

/**
 * Single stub implementing every conversion method pair used across V5 resolvers.
 * Magic variants (__toX) return 'magic'; non-magic (toX) return 'normal'.
 */
class MultiStub
{
    public function __toArray(): array
    {
        return ['magic'];
    }

    public function toArray(): array
    {
        return ['normal'];
    }

    public function __toBool(): bool
    {
        return true;
    }

    public function toBool(): bool
    {
        return false;
    }

    public function __toInteger(): int
    {
        return 1;
    }

    public function __toInt(): int
    {
        return 2;
    }

    public function toInteger(): int
    {
        return 3;
    }

    public function toInt(): int
    {
        return 4;
    }

    public function __toFloat(): float
    {
        return 1.0;
    }

    public function toFloat(): float
    {
        return 2.0;
    }

    public function __toString(): string
    {
        return 'magic';
    }

    public function toString(): string
    {
        return 'normal';
    }
}
