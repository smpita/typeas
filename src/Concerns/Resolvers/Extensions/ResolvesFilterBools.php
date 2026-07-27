<?php

namespace Smpita\TypeAs\Concerns\Resolvers\Extensions;

use Smpita\TypeAs\Concerns\Resolvers\Base\ResolvesBools;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Resolvers\Extensions\AsFilterBool;

trait ResolvesFilterBools
{
    use ResolvesBools;

    /**
     * @throws TypeAsResolutionException
     */
    public function filterBool(mixed $value, ?bool $default = null): bool
    {
        return $this->bool($value, $default, new AsFilterBool());
    }

    public function nullableFilterBool(mixed $value, ?bool $default = null): ?bool
    {
        return $this->nullableBool($value, $default, new AsFilterBool());
    }
}
