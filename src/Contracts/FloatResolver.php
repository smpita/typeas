<?php

namespace Smpita\TypeAs\Contracts;

interface FloatResolver extends TypeAsResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float;
}
