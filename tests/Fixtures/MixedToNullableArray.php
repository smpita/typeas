<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\TypeAs;

class MixedToNullableArray
{
    public mixed $data = null;

    /**
     * @return array<mixed>|null
     */
    public function main(): ?array
    {
        $typed = TypeAs::nullableArray($this->data);

        return $this->test($typed);
    }

    /**
     * @param array<mixed>|null $input
     * @return array<mixed>|null
     */
    private function test(?array $input): ?array
    {
        return $input;
    }
}
