<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\StringResolver;

class StringResolverStub implements StringResolver
{
    public function resolve(mixed $value, ?string $default = null): string
    {
        return '';
    }
}
