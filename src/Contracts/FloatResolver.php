<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface FloatResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?float $default = null): float;
}
