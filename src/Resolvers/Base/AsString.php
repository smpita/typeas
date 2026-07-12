<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\StringResolver;

class AsString implements StringResolver
{
    public function resolve(mixed $value, ?string $default = null): ?string
    {
        return (new AsNullableString())->resolve($value, $default);
    }
}
