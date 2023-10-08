<?php

namespace Smpita\TypeAs\Concerns;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ThrowsErrorExceptions
{
    /**
     * @return never
     *
     * @throws TypeAsResolutionException
     */
    protected static function error(mixed $value)
    {
        $type = is_object($value) ? get_class($value) : gettype($value);

        throw new TypeAsResolutionException("Resolution error converting $type [".class_basename(static::class).']');
    }
}
