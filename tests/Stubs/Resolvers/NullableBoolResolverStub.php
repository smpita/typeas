<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\BoolResolver;

class NullableBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return null;
    }
}
