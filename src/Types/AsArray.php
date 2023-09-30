<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Type;

class AsArray extends Type
{
    public function handle(mixed $value): array
    {
        return match (gettype($value)) {
            'array' => $value,
            'object' => $this->fromObject($value),
            default => [$value],
        };
    }

    protected function fromObject(object $value): array
    {
        return match (true) {
            method_exists($value, '__toArray') => $value->__toArray(),
            method_exists($value, 'toArray') => $value->toArray(),
            default => [$value],
        };
    }
}
