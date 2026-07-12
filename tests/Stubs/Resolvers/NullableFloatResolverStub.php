<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\FloatResolver;

class NullableFloatResolverStub implements FloatResolver
{
    public function resolve(mixed $value, ?float $default = null): ?float
    {
        return null;
    }
}
