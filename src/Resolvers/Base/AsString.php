<?php

namespace Smpita\TypeAs\Resolvers\Base;

use BackedEnum;
use Smpita\TypeAs\Contracts\StringResolver;

class AsString implements StringResolver
{
    public function resolve(mixed $value, ?string $default = null): ?string
    {
        return match (gettype($value)) {
            'string' => $value,
            'object' => $this->fromObject($value),
            'boolean', 'integer', 'double', 'resource' => strval($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?string
    {
        $muted = match (true) {
            $value instanceof BackedEnum => $value->value,
            is_callable([$value, '__toString']) => $value->__toString(),
            is_callable([$value, 'toString']) => $value->toString(),
            default => null,
        };

        return is_string($muted)
            ? $muted
            : null;
    }
}
