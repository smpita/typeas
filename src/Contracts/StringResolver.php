<?php

namespace Smpita\TypeAs\Contracts;

interface StringResolver
{
    public function resolve(mixed $value, string $default = null): string;
}
