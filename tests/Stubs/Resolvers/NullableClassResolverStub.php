<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\ClassResolver;

class NullableClassResolverStub implements ClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function resolve(string $class, mixed $value, ?object $default = null)
    {
        return null;
    }
}
