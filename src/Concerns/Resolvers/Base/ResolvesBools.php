<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesBools
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?BoolResolver $boolResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function bool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= $this->boolResolver ??= ResolverVersion::default()->config()->boolResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool
    {
        $resolver ??= $this->boolResolver ??= ResolverVersion::default()->config()->boolResolver();

        return $resolver->resolve(value: $value, default: $default);
    }

    public function setBoolResolver(?BoolResolver $resolver): void
    {
        $this->boolResolver = $resolver;
    }
}
