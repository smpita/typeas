<?php

namespace Smpita\TypeAs\Contracts;

interface FloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float;
}
