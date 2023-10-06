<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Type;

class AsNullableArray extends Type
{
    public function handle(mixed $value, bool|array $wrap = true): ?array
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
        return match (true) {
            method_exists($value, '__toArray') => $value->__toArray(),
            method_exists($value, 'toArray') => $value->toArray(),
            default => null,
        };
    }
}
