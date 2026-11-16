<?php

namespace Smpita\TypeAs\Contracts;

interface FilterBoolResolver extends TypeAsResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool;
}
