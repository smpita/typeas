<?php

namespace Smpita\TypeAs\Resolvers\Base;

use BackedEnum;
use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\FloatResolver;

class AsFloat implements FloatResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?float $default = null): ?float
    {
        return match (gettype($value)) {
            'double' => $value,
            'NULL' => $default,
            'object' => $this->fromObject($value),
            'boolean', 'string', 'integer', 'resource' => floatval($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?float
    {
        if ($value instanceof BackedEnum) {
            return floatval($value->value);
        }

        $resolved = $this->resolveMethods($value, ['__toFloat', 'toFloat']);

        return is_float($resolved)
            ? $resolved
            : null;
    }
}
