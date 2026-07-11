<?php

namespace Smpita\TypeAs\Contracts;

interface IntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int;
}
