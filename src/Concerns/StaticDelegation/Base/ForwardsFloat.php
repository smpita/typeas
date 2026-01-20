<?php

namespace Smpita\TypeAs\Concerns\StaticDelegation\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsFloat
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function float(mixed $value, ?float $default = null, ?FloatResolver $resolver = null): float
    {
        return static::getInstance()->float(value: $value, default: $default, resolver: $resolver);
    }

    public static function nullableFloat(mixed $value, ?float $default = null, ?NullableFloatResolver $resolver = null): ?float
    {
        return static::getInstance()->nullableFloat(value: $value, default: $default, resolver: $resolver);
    }

    public static function setFloatResolver(?FloatResolver $resolver): void
    {
        static::getInstance()->setFloatResolver($resolver);
    }

    public static function setNullableFloatResolver(?NullableFloatResolver $resolver): void
    {
        static::getInstance()->setNullableFloatResolver($resolver);
    }
}
