<?php

namespace Smpita\TypeAs\Contracts;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

interface ClassResolver
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
    public function resolve(string $class, mixed $value, ?object $default = null);
}
