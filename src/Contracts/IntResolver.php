<?php

namespace Smpita\TypeAs\Contracts;

use UnexpectedValueException;

interface IntResolver
{
    /**
     * @throws UnexpectedValueException
     */
    public function resolve(mixed $value, ?int $default = null): int;
}
