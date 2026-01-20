<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsInt;
use Smpita\TypeAs\Resolvers\Base\AsNullableInt;

trait ResolvesInts
{
    protected ?IntResolver $intResolver = null;

    protected ?NullableIntResolver $nullableIntResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function int(mixed $value, ?int $default = null, ?IntResolver $resolver = null): int
    {
        $resolver ??= $this->intResolver ??= new AsInt;

        return $resolver->resolve($value, $default);
    }

    public function nullableInt(mixed $value, ?int $default = null, ?NullableIntResolver $resolver = null): ?int
    {
        $resolver ??= $this->nullableIntResolver ??= new AsNullableInt;

        return $resolver->resolve($value, $default);
    }

    public function setIntResolver(?IntResolver $resolver): void
    {
        $this->intResolver = $resolver;
    }

    public function setNullableIntResolver(?NullableIntResolver $resolver): void
    {
        $this->nullableIntResolver = $resolver;
    }
}
