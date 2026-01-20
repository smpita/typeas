<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Base;

use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Base\AsNullableString;
use Smpita\TypeAs\Resolvers\Base\AsString;

trait ResolvesStrings
{
    protected ?StringResolver $stringResolver = null;

    protected ?NullableStringResolver $nullableStringResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function string(mixed $value, ?string $default = null, ?StringResolver $resolver = null): string
    {
        $resolver ??= $this->stringResolver ??= new AsString();

        return $resolver->resolve($value, $default);
    }

    public function nullableString(mixed $value, ?string $default = null, ?NullableStringResolver $resolver = null): ?string
    {
        $resolver ??= $this->nullableStringResolver ??= new AsNullableString();

        return $resolver->resolve($value, $default);
    }

    public function setStringResolver(?StringResolver $resolver): void
    {
        $this->stringResolver = $resolver;
    }

    public function setNullableStringResolver(?NullableStringResolver $resolver): void
    {
        $this->nullableStringResolver = $resolver;
    }
}
