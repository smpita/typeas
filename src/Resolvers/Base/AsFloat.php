<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\FloatResolver;

class AsFloat implements FloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float
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
        $muted = match (true) {
            method_exists($value, '__toFloat') => $value->__toFloat(),
            method_exists($value, 'toFloat') => $value->toFloat(),
            default => null,
        };

        return is_float($muted)
            ? $muted
            : null;
    }
}
