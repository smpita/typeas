<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\ArrayResolver;

class AsArray implements ArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array
    {
        return (new AsNullableArray())->resolve($value, $default, $wrap);
    }
}
