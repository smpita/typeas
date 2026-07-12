<?php

namespace Smpita\TypeAs\Contracts;

interface BoolResolver extends TypeAsResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool;
}
