<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;

class AsNullableFloat extends Resolver implements NullableFloatResolver
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
        return match (true) {
            method_exists($value, '__toFloat') => $value->__toFloat(),
            method_exists($value, 'toFloat') => $value->toFloat(),
            default => null,
        };
    }
}
