<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface BoolResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?bool $default = null): bool;
}
