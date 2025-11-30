<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface NullableBoolResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?bool $default = null): ?bool;
}
