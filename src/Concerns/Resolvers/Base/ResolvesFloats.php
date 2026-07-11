<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsFloat;
use Smpita\TypeAs\Resolvers\Base\AsNullableFloat;

trait ResolvesFloats
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?FloatResolver $floatResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        $resolver ??= $this->floatResolver ??= new AsFloat();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value);
    }

    public function nullableFloat(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): ?float
    {
        $resolver ??= $this->floatResolver ??= new AsNullableFloat();

        return $resolver->resolve(value: $value, default: $default);
    }

    public function setFloatResolver(?FloatResolver $resolver): void
    {
        $this->floatResolver = $resolver;
    }
}
