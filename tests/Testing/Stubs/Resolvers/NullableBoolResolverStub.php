<?php

namespace Smpita\TypeAs\Tests\Testing\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\BoolResolver;

class NullableBoolResolverStub implements BoolResolver
{
    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        return null;
    }
}
