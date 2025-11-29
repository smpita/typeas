<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface ArrayResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, ?array $default = null, bool $wrap = true): array;
}
