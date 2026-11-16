<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesBools
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @throws TypeAsResolutionException
     */
    public function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= $this->resolvers()->boolResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool
    {
        $resolver ??= $this->resolvers()->boolResolver();

        return $resolver->resolve(value: $value, default: $default);
    }
}
