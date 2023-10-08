<?php

namespace Smpita\TypeAs\Contracts;

interface NullableIntResolver
{
    public function resolve(mixed $value, int $default = null): ?int;
}
