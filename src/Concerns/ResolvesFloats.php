<?php

namespace Smpita\TypeAs\Concerns;

use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\AsFloat;
use Smpita\TypeAs\Resolvers\AsNullableFloat;

trait ResolvesFloats
{
    protected static ?FloatResolver $floatResolver = null;

    protected static ?NullableFloatResolver $nullableFloatResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public static function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        $resolver ??= static::$floatResolver ?? new AsFloat;

        return $resolver->resolve($value, $default);
    }

    public static function nullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        $resolver ??= static::$nullableFloatResolver ?? new AsNullableFloat;

        return $resolver->resolve($value, $default);
    }

    public static function setFloatResolver(?FloatResolver $resolver): void
    {
        static::$floatResolver = $resolver;
    }

    public static function setNullableFloatResolver(?NullableFloatResolver $resolver): void
    {
        static::$nullableFloatResolver = $resolver;
    }
}
