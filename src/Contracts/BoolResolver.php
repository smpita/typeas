<?php

namespace Smpita\TypeAs\Contracts;

interface BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool;
}
