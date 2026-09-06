<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesArrays
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?ArrayResolver $arrayResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function array(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): array
    {
        $resolver ??= $this->arrayResolver ??= ResolverVersion::default()->config()->arrayResolver();

        return $resolver->resolve(value: $value, default: $default, wrap: $wrap) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableArray(mixed $value, ?array $default = null, ?ArrayResolver $resolver = null, ?bool $wrap = true): ?array
    {
        $resolver ??= $this->arrayResolver ??= ResolverVersion::default()->config()->arrayResolver();

        return $resolver->resolve(value: $value, default: $default, wrap: $wrap);
    }

    public function setArrayResolver(?ArrayResolver $resolver): void
    {
        $this->arrayResolver = $resolver;
    }
}
