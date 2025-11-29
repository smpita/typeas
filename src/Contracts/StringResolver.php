<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface StringResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?string $default = null): string;
}
