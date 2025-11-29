<?php

namespace Smpita\TypeAs\Resolvers;

use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsClass extends Resolver implements ClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws TypeAsResolutionException
     */
    public function resolve(string $class, mixed $value, ?object $default = null): object
    {
        return (new AsNullableClass())->resolve($class, $value, $default) ?? $this->throwResolutionException($value);
    }
}
