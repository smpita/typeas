<?php

namespace Smpita\TypeAs\Concerns\Fluent;

use Smpita\TypeAs\Fluent\NonNullable;

trait DelegatesFluent
{
    public static function from(mixed $value): NonNullable
    {
        return NonNullable::make()->from($value);
    }
}
