<?php

namespace Smpita\TypeAs\Fluent;

use Smpita\TypeAs\Contracts\ArrayResolver;
use Smpita\TypeAs\Contracts\BoolResolver;
use Smpita\TypeAs\Contracts\ClassResolver;
use Smpita\TypeAs\Contracts\FloatResolver;
use Smpita\TypeAs\Contracts\IntResolver;
use Smpita\TypeAs\Contracts\NullableArrayResolver;
use Smpita\TypeAs\Contracts\NullableBoolResolver;
use Smpita\TypeAs\Contracts\NullableClassResolver;
use Smpita\TypeAs\Contracts\NullableFloatResolver;
use Smpita\TypeAs\Contracts\NullableIntResolver;
use Smpita\TypeAs\Contracts\NullableStringResolver;
use Smpita\TypeAs\Contracts\StringResolver;

class TypeConfig
{
    public function __construct(
        public mixed $fromValue = null,
        public mixed $defaultTo = null,
        public ArrayResolver|NullableArrayResolver
            |BoolResolver|NullableBoolResolver
            |ClassResolver|NullableClassResolver
            |FloatResolver|NullableFloatResolver
            |IntResolver|NullableIntResolver
            |StringResolver|NullableStringResolver
            |null $resolveUsing = null,
        public ?bool $arrayWrap = true,
    ) {
    }
}
