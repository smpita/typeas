<?php

namespace Smpita\TypeAs\Resolvers\Base;

use BackedEnum;
use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\IntResolver;

class AsInt implements IntResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return match (gettype($value)) {
            'integer' => $value,
            'NULL' => $default,
            'boolean', 'string', 'double', 'resource' => intval($value),
            'object' => $this->fromObject($value),
            default => null,
        } ?? $default;
    }

    protected function fromObject(object $value): ?int
    {
        if ($value instanceof BackedEnum) {
            return intval($value->value);
        }

        $resolved = $this->resolveMethods($value, ['__toInteger', '__toInt', 'toInteger', 'toInt']);

        return is_int($resolved)
            ? $resolved
            : null;
    }
}
