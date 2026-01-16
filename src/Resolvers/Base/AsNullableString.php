<?php

namespace Smpita\TypeAs\Resolvers\Base;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;

class AsNullableString extends Resolver implements NullableStringResolver
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
            method_exists($value, '__toString') => $value->__toString(),
            method_exists($value, 'toString') => $value->toString(),
            default => null,
        };

        return is_string($muted)
            ? $muted
            : null;
    }
}
