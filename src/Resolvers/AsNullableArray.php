<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;

class AsNullableArray extends Resolver implements NullableArrayResolver
{
    public function resolve(mixed $value, bool|array $wrap = true): ?array
    {
        $array = match (gettype($value)) {
            'array' => $value,
            'object' => $this->fromObject($value),
            default => null,
        };

        if (is_array($array)) {
            return $array;
        }

        if ($wrap === true) {
            return [$value];
        }

        if (is_array($wrap)) {
            return $wrap;
        }

        return null;
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
