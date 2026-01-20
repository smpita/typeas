<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsArray;
use Smpita\TypeAs\Resolvers\Base\AsNullableArray;

trait ResolvesArrays
{
    protected ?ArrayResolver $arrayResolver = null;

    protected ?NullableArrayResolver $nullableArrayResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        $resolver ??= $this->arrayResolver ??= new AsArray;

        return $resolver->resolve(value: $value, default: $default, wrap: $wrap);
    }

    public function nullableArray(mixed $value, ?array $default = null, ?NullableArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        $resolver ??= $this->nullableArrayResolver ??= new AsNullableArray;

        return $resolver->resolve($value, $default, $wrap);
    }

    public function setArrayResolver(?ArrayResolver $resolver): void
    {
        $this->arrayResolver = $resolver;
    }

    public function setNullableArrayResolver(?NullableArrayResolver $resolver): void
    {
        $this->nullableArrayResolver = $resolver;
    }
}
