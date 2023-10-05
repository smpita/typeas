<?php

namespace Smpita\TypeAs\Types;

use DateTimeInterface;
use DateTimeZone;
use Exception;
use Illuminate\Support\Carbon;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsCarbon extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): Carbon
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if (is_string($value) || $value instanceof DateTimeInterface) {
            try {
                return Carbon::parse($value, $tz);
            } catch (Exception $e) {
                if ($default) {
                    return $this->localized($default, $tz);
                }

                throw $e;
            }
        }

        if (is_null($value) && $default) {
            return $this->localized($default, $tz);
        }

        $this->error($value);
    }

    protected function localized(Carbon $carbon, DateTimeZone|string $tz = null): Carbon
    {
        return is_null($tz)
            ? $carbon
            : $carbon->setTimezone($tz);
    }
}
