<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsArray extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, bool|array $wrap = true): array
    {
        return (new AsNullableArray)->handle($value, $wrap) ?? $this->error($value);
    }
}
