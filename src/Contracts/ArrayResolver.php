<?php

namespace Smpita\TypeAs\Contracts;

interface ArrayResolver extends TypeAsResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): ?array;
}
