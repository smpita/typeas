<?php

namespace Smpita\TypeAs\Concerns\StaticDelegation\Fluent;

use Smpita\TypeAs\Fluent\NonNullable;

trait ForwardsNonNullable
{
    public static function from(mixed $value): NonNullable
    {
        return NonNullable::make()->from($value);
    }
}
