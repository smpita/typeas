<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsFloat extends Resolver implements FloatResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?float $default = null): float
    {
        return (new AsNullableFloat())->resolve($value, $default) ?? $this->throwResolutionException($value);
    }
}
