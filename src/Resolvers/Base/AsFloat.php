<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\FloatResolver;

class AsFloat implements FloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float
    {
        return (new AsNullableFloat())->resolve($value, $default);
    }
}
