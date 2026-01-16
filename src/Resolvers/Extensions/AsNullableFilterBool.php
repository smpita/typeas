<?php

namespace Smpita\TypeAs\Resolvers\Extensions;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;

class AsNullableFilterBool extends Resolver implements NullableBoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return is_null($value)
            ? $default
            : filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE) ?? $default;
    }
}
