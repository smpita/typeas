<?php

namespace Smpita\TypeAs;

use Smpita\TypeAs\Concerns\Statics\Base\ForwardsArrayStatics;
use Smpita\TypeAs\Concerns\Statics\Base\ForwardsBoolStatics;
use Smpita\TypeAs\Concerns\Statics\Base\ForwardsClassStatics;
use Smpita\TypeAs\Concerns\Statics\Base\ForwardsFloatStatics;
use Smpita\TypeAs\Concerns\Statics\Base\ForwardsIntStatics;
use Smpita\TypeAs\Concerns\Statics\Base\ForwardsStringStatics;
use Smpita\TypeAs\Concerns\Statics\Extensions\ForwardsFilterBoolStatics;
use Smpita\TypeAs\Concerns\Instance\HandlesTypeFactory;

/**
 * @see \Smpita\TypeAs\TypeFactory
 */
class TypeAs
{
    use ForwardsArrayStatics;
    use ForwardsBoolStatics;
    use ForwardsClassStatics;
    use ForwardsFilterBoolStatics;
    use ForwardsFloatStatics;
    use ForwardsIntStatics;
    use ForwardsStringStatics;
    use HandlesTypeFactory;
}
