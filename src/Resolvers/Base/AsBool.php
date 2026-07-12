<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\BoolResolver;

class AsBool implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return (new AsNullableBool())->resolve($value, $default);
    }
}
