<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsString extends Resolver implements StringResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?string $default = null): string
    {
        return (new AsNullableString())->resolve($value, $default) ?? $this->throwResolutionException($value);
    }
}
