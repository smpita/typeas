<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

abstract class Type
{
    /**
     * @return never
     *
     * @throws TypeAsResolutionException
     */
    protected static function error(mixed $value)
    {
        $type = is_object($value) ? get_class($value) : gettype($value);

        throw new TypeAsResolutionException("Resolution error converting $type to a string");
    }
}
