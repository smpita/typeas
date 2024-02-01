<?php

namespace Smpita\TypeAs\Contracts;

use UnexpectedValueException;

interface FloatResolver
{
    /**
     * @throws UnexpectedValueException
     */
    public function resolve(mixed $value, ?float $default = null): float;
}
