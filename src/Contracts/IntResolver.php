<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface IntResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?int $default = null): int;
}
