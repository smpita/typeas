<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\IntResolver;

class AsInt implements IntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return (new AsNullableInt())->resolve($value, $default);
    }
}
