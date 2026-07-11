<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\ArrayResolver;

class AsArray extends Resolver implements ArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array
    {
        return (new AsNullableArray())->resolve($value, $default, $wrap);
    }
}
