<?php

namespace Smpita\TypeAs\Types;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\Type;

class AsString extends Type
{
    /**
     * @throws TypeAsResolutionException
     */
    public function handle(mixed $value, string $default = null): string
    {
        return (new AsNullableString)->handle($value, $default) ?? $this->error($value);
    }
}
