<?php

namespace Smpita\TypeAs\Contracts;

use UnexpectedValueException;

interface ClassResolver
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass
     *
     * @throws UnexpectedValueException
     */
    public function resolve(string $class, mixed $value, object $default = null);
}
