<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsArray extends Resolver implements ArrayResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): array
    {
        return (new AsNullableArray)->resolve($value, $default, $wrap) ?? $this->throwResolutionException($value);
    }
}
