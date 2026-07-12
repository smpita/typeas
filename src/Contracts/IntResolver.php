<?php

namespace Smpita\TypeAs\Contracts;

interface IntResolver extends TypeAsResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int;
}
