<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesFloats
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?FloatResolver $floatResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        $resolver ??= $this->floatResolver ??= ResolverVersion::default()->config()->floatResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): ?float
    {
        $resolver ??= $this->floatResolver ??= ResolverVersion::default()->config()->floatResolver();

        return $resolver->resolve(value: $value, default: $default);
    }

    public function setFloatResolver(?FloatResolver $resolver): void
    {
        $this->floatResolver = $resolver;
    }
}
