<?php

namespace Smpita\TypeAs\Contracts;

interface NullableArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array;
}
