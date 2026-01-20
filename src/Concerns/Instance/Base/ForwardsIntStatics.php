<?php

namespace Smpita\TypeAs\Concerns\Instance\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsIntStatics
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        return static::getInstance()->int(value: $value, default: $default, resolver: $resolver);
    }

    public static function nullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        return static::getInstance()->nullableInt(value: $value, default: $default, resolver: $resolver);
    }

    public static function setIntResolver(?IntResolver $resolver): void
    {
        static::getInstance()->setIntResolver($resolver);
    }

    public static function setNullableIntResolver(?NullableIntResolver $resolver): void
    {
        static::getInstance()->setNullableIntResolver($resolver);
    }
}
