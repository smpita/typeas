<?php

namespace Smpita\TypeAs\Resolvers\Extensions;

use Smpita\TypeAs\Contracts\BoolResolver;

class AsNullableFilterBool implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return is_null($value)
            ? $default
            : filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE) ?? $default;
    }
}
