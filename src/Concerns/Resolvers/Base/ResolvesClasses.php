<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\Resolvers\HandlesResolverRegistration;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesClasses
{
    use HandlesResolverRegistration;
    use ThrowsTypeAsResolutionExceptions;

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws TypeAsResolutionException
     */
    public function class(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)
    {
        $resolver ??= $this->resolvers()->classResolver();

        return $resolver->resolve(class: $class, value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function nullableClass(string $class, mixed $value, ?object $default = null, ?ClassResolver $resolver = null)
    {
        $resolver ??= $this->resolvers()->classResolver();

        return $resolver->resolve(class: $class, value: $value, default: $default);
    }
}
