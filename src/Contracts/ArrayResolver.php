<?php

namespace Smpita\TypeAs\Contracts;

use UnexpectedValueException;

interface ArrayResolver
{
    /**
     * @throws UnexpectedValueException
     */
    public function resolve(mixed $value, bool|array $wrap = true): array;
}
