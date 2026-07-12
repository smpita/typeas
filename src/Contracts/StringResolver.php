<?php

namespace Smpita\TypeAs\Contracts;

interface StringResolver extends TypeAsResolver
{
    public function resolve(mixed $value, ?string $default = null): ?string;
}
