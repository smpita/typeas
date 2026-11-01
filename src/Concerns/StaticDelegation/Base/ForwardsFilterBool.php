<?php

namespace Smpita\TypeAs\Concerns\StaticDelegation\Base;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Contracts\FilterBoolResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsFilterBool
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function filterBool(mixed $value, ?bool $default = null, ?FilterBoolResolver $resolver = null): bool
    {
        return static::getInstance()->filterBool(value: $value, default: $default, resolver: $resolver);
    }

    public static function nullableFilterBool(mixed $value, ?bool $default = null, ?FilterBoolResolver $resolver = null): ?bool
    {
        return static::getInstance()->nullableFilterBool(value: $value, default: $default, resolver: $resolver);
    }

    public static function setFilterBoolResolver(?FilterBoolResolver $resolver): void
    {
        static::getInstance()->resolvers()->setFilterBoolResolver($resolver);
    }
}
