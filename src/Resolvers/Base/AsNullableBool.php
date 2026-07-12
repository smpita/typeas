<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\BoolResolver;

class AsNullableBool implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return is_null($value)
            ? $default
            : boolval($value);
    }
}
