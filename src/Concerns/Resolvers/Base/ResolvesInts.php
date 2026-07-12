<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsInt;

trait ResolvesInts
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?IntResolver $intResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        $resolver ??= $this->intResolver ??= new AsInt();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableInt(mixed $value, ?int $default = null, ?IntResolver $resolver = null): ?int
    {
        $resolver ??= $this->intResolver ??= new AsInt();

        return $resolver->resolve(value: $value, default: $default);
    }

    public function setIntResolver(?IntResolver $resolver): void
    {
        $this->intResolver = $resolver;
    }
}
