<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\BoolResolver;

class AsBool extends Resolver implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return (new AsNullableBool())->resolve($value, $default);
    }
}
