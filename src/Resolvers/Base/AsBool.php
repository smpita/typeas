<?php

namespace Smpita\TypeAs\Resolvers\Base;

use BackedEnum;
use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\BoolResolver;

class AsBool implements BoolResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return match (gettype($value)) {
            'boolean' => $value,
            'NULL' => $default,
            'object' => $this->fromObject($value),
            default => boolval($value),
        } ?? $default;
    }

    protected function fromObject(object $value): ?bool
    {
        if ($value instanceof BackedEnum) {
            return boolval($value->value);
        }

        $resolved = $this->resolveMethods($value, ['__toBool', 'toBool']);

        return is_bool($resolved)
            ? $resolved
            : boolval($value);
    }
}
