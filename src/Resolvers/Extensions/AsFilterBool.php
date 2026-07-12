<?php

namespace Smpita\TypeAs\Resolvers\Extensions;

use Smpita\TypeAs\Contracts\BoolResolver;

class AsFilterBool implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return (new AsNullableFilterBool())->resolve($value, $default);
    }
}
