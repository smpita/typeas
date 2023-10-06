<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsFloat extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, float $default = null): float
    {
        return (new AsNullableFloat)->handle($value, $default) ?? $this->error($value);
    }
}
