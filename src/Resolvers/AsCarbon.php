<?php

namespace Smpita\TypeAs\Resolvers;

use DateTimeZone;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\CarbonResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

class AsCarbon extends Resolver implements CarbonResolver
{
    /**
     * @throws TypeAsResolutionException
     */
    public function resolve(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): Carbon
    {
        return (new AsNullableCarbon)->resolve($value, $tz, $default) ?? $this->error($value);
    }
}
