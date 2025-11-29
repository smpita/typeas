<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface ArrayResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, bool|array $wrap = true): array;
}
