<?php

namespace Smpita\TypeAs\Types;

use DateTimeZone;
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
        return (new AsNullableCarbon)->handle($value, $tz, $default) ?? $this->error($value);
    }
}
