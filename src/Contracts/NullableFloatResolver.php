<?php

namespace Smpita\TypeAs\Contracts;

interface NullableFloatResolver
{
    public function resolve(mixed $value, float $default = null): ?float;
}
