<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesStrings
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @throws TypeAsResolutionException
     */
    public function string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        $resolver ??= $this->resolvers()->stringResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): ?string
    {
        $resolver ??= $this->resolvers()->stringResolver();

        return $resolver->resolve(value: $value, default: $default);
    }
}
