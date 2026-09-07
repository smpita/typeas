<?php

namespace Smpita\TypeAs\Tests\Stubs\Objects;

/**
 * Generic test object with configurable public methods.
 * Methods: hello, first, second, third, getValue, methodA, methodB, methodC.
 * Return values controlled via $returns constructor map.
 */
class MethodObjectStub
{
    /** @var array<string, mixed>  named return values */
    public readonly array $returns;

    /** @param array<string, mixed> $returns  name => value for each method */
    public function __construct(array $returns = [])
    {
        $this->returns = $returns;
    }

    public function hello(): string
    {
        return $this->returns['hello'] ?? 'default-hello';
    }
    public function first(): mixed
    {
        return $this->returns['first'] ?? 'default-first';
    }
    public function second(): mixed
    {
        return $this->returns['second'] ?? 'default-second';
    }
    public function third(): mixed
    {
        return $this->returns['third'] ?? 'default-third';
    }
    public function getValue(): int
    {
        return $this->returns['getValue'] ?? 0;
    }
    public function methodA(): string
    {
        return $this->returns['methodA'] ?? 'a';
    }
    public function methodB(): string
    {
        return $this->returns['methodB'] ?? 'b';
    }
    public function methodC(): string
    {
        return $this->returns['methodC'] ?? 'c';
    }

    /** Return all configured methods as an array of [name => value] pairs. */
    public function getAll(): array
    {
        return $this->returns;
    }
}
