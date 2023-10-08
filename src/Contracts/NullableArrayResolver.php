<?php

namespace Smpita\TypeAs\Contracts;

interface NullableArrayResolver
{
    public function resolve(mixed $value, bool|array $wrap = true): ?array;
}
