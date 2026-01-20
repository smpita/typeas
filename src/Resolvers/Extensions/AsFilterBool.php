<?php

namespace Smpita\TypeAs\Resolvers\Extensions;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsFilterBool extends Resolver implements BoolResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        return (new AsNullableFilterBool)->resolve($value, $default) ?? $this->throwResolutionException($value);
    }
}
