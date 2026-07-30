<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToNullableString
{
    public mixed $data = null;

    public function main(): ?string
    {
        $typed = TypeAs::nullableString($this->data);

        return $this->test($typed);
    }

    private function test(?string $input): ?string
    {
        return $input;
    }
}
