<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsFloat;
use Smpita\TypeAs\Resolvers\Base\AsNullableFloat;

trait ResolvesFloats
{
    protected ?FloatResolver $floatResolver = null;

    protected ?NullableFloatResolver $nullableFloatResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        $resolver ??= $this->floatResolver ??= new AsFloat;

        return $resolver->resolve($value, $default);
    }

    public function nullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        $resolver ??= $this->nullableFloatResolver ??= new AsNullableFloat;

        return $resolver->resolve($value, $default);
    }

    public function setFloatResolver(?FloatResolver $resolver): void
    {
        $this->floatResolver = $resolver;
    }

    public function setNullableFloatResolver(?NullableFloatResolver $resolver): void
    {
        $this->nullableFloatResolver = $resolver;
    }
}
