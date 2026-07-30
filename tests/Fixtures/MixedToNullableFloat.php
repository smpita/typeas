<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToNullableFloat
{
    public mixed $data = null;

    public function main(): ?float
    {
        $typed = TypeAs::nullableFloat($this->data);

        return $this->test($typed);
    }

    private function test(?float $input): ?float
    {
        return $input;
    }
}
