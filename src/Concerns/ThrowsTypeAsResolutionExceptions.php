<?php

namespace Smpita\TypeAs\Concerns;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ThrowsTypeAsResolutionExceptions
{
    /**
     * @return never
     *
     * @throws TypeAsResolutionException
     */
    protected static function throwResolutionException(mixed $value)
    {
        $type = is_object($value) ? get_class($value) : gettype($value);
        $classname = basename(str_replace('\\', '/', static::class));

        throw new TypeAsResolutionException("Resolution error converting $type [".$classname.']');
    }
}
