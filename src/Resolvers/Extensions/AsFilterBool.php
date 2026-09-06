<?php

namespace Smpita\TypeAs\Resolvers\Extensions;

use BackedEnum;
use Smpita\TypeAs\Concerns\Resolvers\Object\ResolvesMethods;
use Smpita\TypeAs\Contracts\BoolResolver;

class AsFilterBool implements BoolResolver
{
    use ResolvesMethods;

    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return match (gettype($value)) {
            'boolean' => $value,
            'NULL' => $default,
            'object' => $this->fromObject($value),
            default => $this->filterBool($value),
        } ?? $default;
    }

    protected function fromObject(object $value): ?bool
    {
        if ($value instanceof BackedEnum) {
            return $this->filterBool($value->value);
        }

        $resolved = $this->resolveMethods($value, ['__toBool', 'toBool']);

        return is_bool($resolved)
            ? $resolved
            : null;
    }

    protected function filterBool(mixed $value): ?bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
    }
}
