<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\BoolResolver;

class FilterBoolResolverStub implements BoolResolver
{
    public mixed $lastValue = null;

    public function resolve(mixed $value, ?bool $default = null): ?bool
    {
        $this->lastValue = $value;
        return (bool) $value;
    }
}
