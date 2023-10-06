<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Type;

class AsNullableString extends Type
{
    public function handle(mixed $value, string $default = null): ?string
    {
        return match (gettype($value)) {
            'string' => $value,
            'object' => $this->fromObject($value),
            'boolean', 'integer', 'double', 'resource' => strval($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?string
    {
        return match (true) {
            method_exists($value, '__toString') => $value->__toString(),
            method_exists($value, 'toString') => $value->toString(),
            default => null,
        };
    }
}
