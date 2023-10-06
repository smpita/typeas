<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Type;

class AsNullableFloat extends Type
{
    public function handle(mixed $value, float $default = null): ?float
    {
        return match (gettype($value)) {
            'double' => $value,
            'object' => $this->fromObject($value),
            'boolean', 'string', 'integer', 'resource' => floatval($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?float
    {
        return match (true) {
            method_exists($value, '__toFloat') => $value->__toFloat(),
            method_exists($value, 'toFloat') => $value->toFloat(),
            default => null,
        };
    }
}
