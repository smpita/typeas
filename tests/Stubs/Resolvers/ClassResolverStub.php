<?php

namespace Smpita\TypeAs\Tests\Stubs\Resolvers;

use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class ClassResolverStub implements ClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws \Smpita\TypeAs\Exceptions\TypeAsResolutionException
     */
    public function resolve(string $class, mixed $value, ?object $default = null)
    {
        if (class_exists($class)) {
            return new $class();
        }

        throw new TypeAsResolutionException();
    }
}
