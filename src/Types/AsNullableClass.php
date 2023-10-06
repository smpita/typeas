<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Type;

class AsNullableClass extends Type
{
    /**
     * @template TClass of object
     *
     * @param  class-string<TClass>  $class
     * @param  TClass  $default
     * @return TClass|null
     */
    public function handle(string $class, mixed $value, object $default = null)
    {
        return is_object($value) && is_a($value, $class)
            ? $value
            : $default;
    }
}
