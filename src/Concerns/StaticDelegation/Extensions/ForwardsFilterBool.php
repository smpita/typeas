<?php

namespace Smpita\TypeAs\Concerns\StaticDelegation\Extensions;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsFilterBool
{
    use HandlesTypeFactory;

    /**
     * @throws TypeAsResolutionException
     */
    public static function filterBool(mixed $value, ?bool $default = null): bool
    {
        return static::getInstance()->filterBool(value: $value, default: $default);
    }

    public static function nullableFilterBool(mixed $value, ?bool $default = null): ?bool
    {
        return static::getInstance()->nullableFilterBool(value: $value, default: $default);
    }
}
