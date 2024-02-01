<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;

class AsNullableInt extends Resolver implements NullableIntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return match (gettype($value)) {
            'integer' => $value,
            'boolean', 'string', 'double', 'resource' => intval($value),
            'object' => $this->fromObject($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?int
    {
        return match (true) {
            method_exists($value, '__toInteger') => $value->__toInteger(),
            method_exists($value, 'toInteger') => $value->toInteger(),
            default => null,
        };
    }
}
