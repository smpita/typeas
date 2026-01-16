<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Extensions;

use Smpita\TypeAs\Resolvers\Extensions\AsFilterBool;
use Smpita\TypeAs\Resolvers\Extensions\AsNullableFilterBool;
use Smpita\TypeAs\TypeAs;

trait ResolvesFilterBools
{
    public static function filterBool(mixed $value, ?bool $default = null): bool
    {
        return TypeAs::bool($value, $default, new AsFilterBool());
    }

    public static function nullableFilterBool(mixed $value, ?bool $default = null): ?bool
    {
        return TypeAs::nullableBool($value, $default, new AsNullableFilterBool());
    }
}
