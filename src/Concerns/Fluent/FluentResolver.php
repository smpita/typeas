<?php

namespace Smpita\TypeAs\Concerns\Fluent;

use Smpita\TypeAs\Fluent\Strict;

trait FluentResolver
{
    public static function from(mixed $value): Strict
    {
        return Strict::new()->from($value);
    }
}
