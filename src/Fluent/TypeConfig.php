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

final class TypeConfig
{
    public function __construct(
        public mixed $fromValue = null,
        public mixed $defaultTo = null,
        public ?ArrayResolver $arrayResolver = null,
        public ?NullableArrayResolver $nullableArrayResolver = null,
        public ?BoolResolver $boolResolver = null,
        public ?NullableBoolResolver $nullableBoolResolver = null,
        public ?ClassResolver $classResolver = null,
        public ?NullableClassResolver $nullableClassResolver = null,
        public ?FloatResolver $floatResolver = null,
        public ?NullableFloatResolver $nullableFloatResolver = null,
        public ?IntResolver $intResolver = null,
        public ?NullableIntResolver $nullableIntResolver = null,
        public ?StringResolver $stringResolver = null,
        public ?NullableStringResolver $nullableStringResolver = null,
        public ?bool $arrayWrap = true,
    ) {
    }
}
