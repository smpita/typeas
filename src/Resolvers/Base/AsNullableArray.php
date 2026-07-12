<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Contracts\ArrayResolver;

class AsNullableArray implements ArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array
    {
        $array = match (gettype($value)) {
            'array' => $value,
            'object' => $this->fromObject($value),
            'NULL' => $default,
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
        $muted = match (true) {
            method_exists($value, '__toArray') => $value->__toArray(),
            method_exists($value, 'toArray') => $value->toArray(),
            default => null,
        };

        return is_array($muted)
            ? $muted
            : null;
    }
}
