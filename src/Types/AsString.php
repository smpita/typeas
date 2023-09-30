<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsString extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, string $default = null): string
    {
        return match (gettype($value)) {
            'string' => $value,
            'object' => $this->fromObject($value),
            'boolean', 'integer', 'double', 'resource' => strval($value),
            default => null,
        } ?? $default ?? $this->error($value);
    }

    /**
     * @return ?string
     *
     * @throws TypeAsResolutionException
     */
    protected function fromObject(object $value): ?string
    {
        return match (true) {
            method_exists($value, '__toString') => $value->__toString(),
            method_exists($value, 'toString') => $value->toString(),
            default => null,
        };
    }
}
