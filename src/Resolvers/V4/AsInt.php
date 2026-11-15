<?php

namespace Smpita\TypeAs\Resolvers\V4;

use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\IntResolver;

class AsInt implements IntResolver
{
    use ResolvesMethods;

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
        $resolved = $this->resolveMethods($value, ['__toInteger', 'toInteger']);

        return is_int($resolved)
            ? $resolved
            : null;
    }
}
