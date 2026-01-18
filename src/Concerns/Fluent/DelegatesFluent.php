<?php

namespace Smpita\TypeAs\Concerns\Fluent;

use Smpita\TypeAs\Fluent\Strict;

trait DelegatesFluent
{
    public static function from(mixed $value): Strict
    {
        return Strict::new()->from($value);
    }
}
