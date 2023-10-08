<?php

namespace Smpita\TypeAs\Contracts;

use DateTimeZone;
use Illuminate\Support\Carbon;

interface NullableCarbonResolver
{
    public function resolve(mixed $value, DateTimeZone|string $tz = null, Carbon $default = null): ?Carbon;
}
