<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\ArrayResolver;

class AsArray implements ArrayResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array
    {
        $array = match (gettype($value)) {
            'array' => $value,
            'NULL' => $default,
            'object' => $this->fromObject($value),
            default => null,
        };

        if (is_array($array)) {
            return $array;
        }

        if ($wrap === true) {
            return [$value];
        }

        return $default;
    }

    protected function fromObject(object $value): ?array
    {
        $resolved = $this->resolveMethods($value, ['__toArray', 'toArray']);

        return is_array($resolved)
            ? $resolved
            : null;
    }
}
