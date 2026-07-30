<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\TypeAs;

class MixedToNullableClass
{
    public mixed $data = null;

    public function main(): ?object
    {
        $typed = TypeAs::nullableClass(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    private function test(?object $input): ?object
    {
        return $input;
    }
}
