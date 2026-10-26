<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\FilterBoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesFilterBools
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @throws TypeAsResolutionException
     */
    public function filterBool(mixed $value, ?bool $default = null, ?FilterBoolResolver $resolver = null): bool
    {
        $resolver ??= $this->resolvers()->filterBoolResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableFilterBool(mixed $value, ?bool $default = null, ?FilterBoolResolver $resolver = null): ?bool
    {
        $resolver ??= $this->resolvers()->filterBoolResolver();

        return $resolver->resolve(value: $value, default: $default);
    }
}
