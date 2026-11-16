<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\IntResolver;

class NullableIntResolverStub implements IntResolver
{
    public function resolve(mixed $value, ?int $default = null): ?int
    {
        return null;
    }
}
