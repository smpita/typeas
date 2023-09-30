<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsInteger extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, int $default = null): int
    {
        return match (gettype($value)) {
            'integer' => $value,
            'boolean', 'string', 'double', 'resource' => intval($value),
            'object' => $this->fromObject($value),
            default => null,
        } ?? $default ?? $this->error($value);
    }

    protected function fromObject(object $value): ?int
    {
        return match (true) {
            method_exists($value, '__toInteger') => $value->__toInteger(),
            method_exists($value, 'toInteger') => $value->toInteger(),
            default => null,
        };
    }
}
