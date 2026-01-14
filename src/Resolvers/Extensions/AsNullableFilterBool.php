<?php

namespace Smpita\TypeAs\Resolvers\Extensions;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;

class AsNullableFilterBool extends Resolver implements NullableBoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return match (gettype($value)) {
            'string' => filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'NULL' => $default,
            default => boolval($value),
        };
    }
}
