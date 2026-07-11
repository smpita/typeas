<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\ArrayResolver;

class ArrayResolverStub implements ArrayResolver
{
    public function resolve(mixed $value, ?array $default = null, ?bool $wrap = true): array
    {
        return [];
    }
}
