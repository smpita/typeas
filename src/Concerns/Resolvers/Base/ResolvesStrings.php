<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Concerns\ThrowsTypeAsResolutionExceptions;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Config\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesStrings
{
    use ThrowsTypeAsResolutionExceptions;

    protected ?StringResolver $stringResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        $resolver ??= $this->stringResolver ??= ResolverVersion::default()->config()->stringResolver();

        return $resolver->resolve(value: $value, default: $default) ?? static::throwResolutionException($value, $resolver);
    }

    public function nullableString(mixed $value, ?string $default = null, ?StringResolver $resolver = null): ?string
    {
        $resolver ??= $this->stringResolver ??= ResolverVersion::default()->config()->stringResolver();

        return $resolver->resolve(value: $value, default: $default);
    }

    public function setStringResolver(?StringResolver $resolver): void
    {
        $this->stringResolver = $resolver;
    }
}
