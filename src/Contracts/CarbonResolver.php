<?php

namespace Smpita\TypeAs\Contracts;

use DateTimeZone;
use Illuminate\Support\Carbon;
use UnexpectedValueException;

interface CarbonResolver
{
    /**
     * @throws UnexpectedValueException
     */
    public function resolve(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): Carbon;
}
