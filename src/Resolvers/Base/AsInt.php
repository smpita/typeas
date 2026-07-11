<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\IntResolver;

class AsInt extends Resolver implements IntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return (new AsNullableInt())->resolve($value, $default);
    }
}
