<?php

namespace Smpita\TypeAs\Resolvers\Base;

use BackedEnum;
use Smpita\TypeAs\Contracts\IntResolver;

class AsInt implements IntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return match (gettype($value)) {
            'integer' => $value,
            'boolean', 'string', 'double', 'resource' => intval($value),
            'object' => $this->fromObject($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?int
    {
        $muted = match (true) {
            $value instanceof BackedEnum => $value->value,
            is_callable([$value, '__toInteger']) => $value->__toInteger(),
            is_callable([$value, '__toInt']) => $value->__toInt(),
            is_callable([$value, 'toInteger']) => $value->toInteger(),
            is_callable([$value, 'toInt']) => $value->toInt(),
            default => null,
        };

        return is_int($muted)
            ? $muted
            : null;
    }
}
