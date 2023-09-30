<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsArray extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, bool|array $wrap = true): array
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

        $this->error($value);
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
