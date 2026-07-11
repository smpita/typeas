<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\BoolResolver;

class AsNullableBool extends Resolver implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return is_null($value)
            ? $default
            : boolval($value);
    }
}
