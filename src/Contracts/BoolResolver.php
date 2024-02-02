<?php

namespace Smpita\TypeAs\Contracts;

use UnexpectedValueException;

interface BoolResolver
{
    /**
     * @throws UnexpectedValueException
     */
    public function resolve(mixed $value, ?bool $default = null): bool;
}
