<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesFloats
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @throws TypeAsResolutionException
     */
    public function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        $resolver ??= $this->resolvers()->floatResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): ?float
    {
        $resolver ??= $this->resolvers()->floatResolver();

        return $resolver->resolve(value: $value, default: $default);
    }
}
