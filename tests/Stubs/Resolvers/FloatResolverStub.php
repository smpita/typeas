<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\FloatResolver;

class FloatResolverStub implements FloatResolver
{
    public function resolve(mixed $value, ?float $default = null): float
    {
        return 0.0;
    }
}
