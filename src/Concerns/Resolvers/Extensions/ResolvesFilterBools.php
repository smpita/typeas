<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Extensions;

use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesBools;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Enums\ResolverVersion;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ResolvesFilterBools
{
    use ResolvesBools;

    protected ?BoolResolver $filterBoolResolver = null;

    /**
     * @throws TypeAsResolutionException
     */
    public function filterBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): bool
    {
        $resolver ??= $this->filterBoolResolver ??= ResolverVersion::default()->config()->filterBoolResolver();

        return $this->bool($value, $default, $resolver);
    }

    public function nullableFilterBool(mixed $value, ?bool $default = null, ?BoolResolver $resolver = null): ?bool
    {
        $resolver ??= $this->filterBoolResolver ??= ResolverVersion::default()->config()->filterBoolResolver();

        return $this->nullableBool($value, $default, $resolver);
    }

    public function setFilterBoolResolver(?BoolResolver $resolver): void
    {
        $this->filterBoolResolver = $resolver;
    }
}
