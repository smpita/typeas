<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToNullableBool
{
    public mixed $data = null;

    public function main(): ?bool
    {
        $typed = TypeAs::nullableBool($this->data);

        return $this->test($typed);
    }

    private function test(?bool $input): ?bool
    {
        return $input;
    }
}
