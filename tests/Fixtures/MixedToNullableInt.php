<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToNullableInt
{
    public mixed $data = null;

    public function main(): ?int
    {
        $typed = TypeAs::nullableInt($this->data);

        return $this->test($typed);
    }

    private function test(?int $input): ?int
    {
        return $input;
    }
}
