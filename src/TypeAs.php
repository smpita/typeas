<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;
use Smpita\TypeAs\Concerns\Fluent\FluentResolver;
use Smpita\TypeAs\Concerns\StaticDelegation\Base\ForwardsArray;
use Smpita\TypeAs\Concerns\StaticDelegation\Base\ForwardsBool;
use Smpita\TypeAs\Concerns\StaticDelegation\Base\ForwardsClass;
use Smpita\TypeAs\Concerns\StaticDelegation\Base\ForwardsFloat;
use Smpita\TypeAs\Concerns\StaticDelegation\Base\ForwardsInt;
use Smpita\TypeAs\Concerns\StaticDelegation\Base\ForwardsString;
use Smpita\TypeAs\Concerns\StaticDelegation\Extensions\ForwardsFilterBool;

/**
 * @see \Smpita\TypeAs\TypeFactory
 */
class TypeAs
{
    use FluentResolver;
    use ForwardsArray;
    use ForwardsBool;
    use ForwardsClass;
    use ForwardsFilterBool;
    use ForwardsFloat;
    use ForwardsInt;
    use ForwardsString;
    use HandlesTypeFactory;
}
