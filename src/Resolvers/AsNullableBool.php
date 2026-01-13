<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;

class AsNullableBool extends Resolver implements NullableBoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return match (gettype($value)) {
            'string' => filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? true,
            'NULL' => $default,
            default => boolval($value),
        };
    }
}
