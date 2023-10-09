<?php

namespace Smpita\TypeAs\Resolvers;

use DateTimeInterface;
use DateTimeZone;
use Exception;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Abstracts\Resolver;
use Smpita\TypeAs\Contracts\NullableCarbonResolver;

/**
 * @deprecated v2.5.0
 */
class AsNullableCarbon extends Resolver implements NullableCarbonResolver
{
    public function resolve(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): ?Carbon
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if (is_string($value) || $value instanceof DateTimeInterface) {
            try {
                return Carbon::parse($value, $tz);
            } catch (Exception) {
                return $default
                    ? $this->localized($default, $tz)
                    : null;
            }
        }

        if (is_null($value) && $default) {
            return $this->localized($default, $tz);
        }

        return null;
    }

    protected function localized(Carbon $carbon, DateTimeZone|string $tz = null): Carbon
    {
        return is_null($tz)
            ? $carbon
            : $carbon->setTimezone($tz);
    }
}
