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
    public function resolve(mixed $value, bool|array $wrap = true): array
    {
        return (new AsNullableArray)->resolve($value, $wrap) ?? $this->error($value);
    }
}
