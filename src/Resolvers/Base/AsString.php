<?php

namespace Smpita\TypeAs\Resolvers\Base;

use BackedEnum;
use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\StringResolver;

class AsString implements StringResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?string $default = null): ?string
    {
        return match (gettype($value)) {
            'string' => $value,
            'NULL' => $default,
            'object' => $this->fromObject($value),
            'boolean', 'integer', 'double', 'resource' => strval($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?string
    {
        if ($value instanceof BackedEnum) {
            return strval($value->value);
        }

        $resolved = $this->resolveMethods($value, ['__toString', 'toString']);

        return is_string($resolved)
            ? $resolved
            : null;
    }
}
