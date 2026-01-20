<?php

namespace Smpita\TypeAs\Concerns\Instance\Extensions;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeAsService;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ForwardsFilterBoolStatics
{
    use HandlesTypeAsService;

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
