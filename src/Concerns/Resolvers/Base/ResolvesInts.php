<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesInts
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @throws TypeAsResolutionException
     */
    public function int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        $resolver ??= $this->resolvers()->intResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): ?int
    {
        $resolver ??= $this->resolvers()->intResolver();

        return $resolver->resolve(value: $value, default: $default);
    }
}
