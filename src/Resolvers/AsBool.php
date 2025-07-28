<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsBool extends Resolver implements BoolResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?bool $default = null): bool
    {
        return (new AsNullableBool())->resolve($value, $default) ?? $this->error($value);
    }
}
