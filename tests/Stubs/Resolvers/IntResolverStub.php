<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\IntResolver;

class IntResolverStub implements IntResolver
{
    public function resolve(mixed $value, ?int $default = null): int
    {
        return 0;
    }
}
