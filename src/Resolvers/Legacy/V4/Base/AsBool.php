<?php

namespace Smpita\TypeAs\Resolvers\Legacy\V4\Base;

use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\BoolResolver;

class AsBool implements BoolResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return is_null($value)
            ? $default
            : boolval($value);
    }
}
