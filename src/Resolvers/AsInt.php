<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsInt extends Resolver implements IntResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?int $default = null): int
    {
        return (new AsNullableInt())->resolve($value, $default) ?? $this->throwResolutionException($value);
    }
}
