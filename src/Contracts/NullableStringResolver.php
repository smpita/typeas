<?php

namespace Smpita\TypeAs\Contracts;

interface NullableStringResolver
{
    public function resolve(mixed $value, string $default = null): ?string;
}
