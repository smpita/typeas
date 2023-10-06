<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsInt extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, int $default = null): int
    {
        return (new AsNullableInt)->handle($value, $default) ?? $this->error($value);
    }
}
