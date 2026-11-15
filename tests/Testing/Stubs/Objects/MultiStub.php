<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Objects;

class MultiStub
{
    public const PROTECTED_VALUE = 'protected';
    public const PRIVATE_VALUE = 'private';

    public function __construct(public mixed $value = null)
    {
    }

    public function __toArray(): array
    {
        return (array) $this->value;
    }

    public function toArray(): array
    {
        return (array) $this->value;
    }

    public function __toBool(): bool
    {
        return (int) $this->value;
    }

    public function toBool(): bool
    {
        return (int) $this->value;
    }

    public function __toInteger(): int
    {
        return (int) $this->value;
    }

    public function __toInt(): int
    {
        return (int) $this->value;
    }

    public function toInteger(): int
    {
        return (int) $this->value;
    }

    public function toInt(): int
    {
        return (int) $this->value;
    }

    public function __toFloat(): float
    {
        return (float) $this->value;
    }

    public function toFloat(): float
    {
        return (float) $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function toString(): string
    {
        return (string) $this->value;
    }

    public function __toNull(): mixed
    {
        return null;
    }

    public function toNull(): mixed
    {
        return null;
    }

    protected function protected(): string
    {
        return self::PROTECTED_VALUE;
    }

    private function private(): string
    {
        return self::PRIVATE_VALUE;
    }
}
