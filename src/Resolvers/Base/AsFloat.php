<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\FloatResolver;

class AsFloat extends Resolver implements FloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float
    {
        return (new AsNullableFloat())->resolve($value, $default);
    }
}
