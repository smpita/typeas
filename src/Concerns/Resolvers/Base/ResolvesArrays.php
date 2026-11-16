<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesArrays
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @throws TypeAsResolutionException
     */
    public function array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        $resolver ??= $this->resolvers()->arrayResolver();

        return $resolver->resolve(value: $value, default: $default, wrap: $wrap) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        $resolver ??= $this->resolvers()->arrayResolver();

        return $resolver->resolve(value: $value, default: $default, wrap: $wrap);
    }
}
