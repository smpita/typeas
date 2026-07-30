<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Fixtures;

use Smpita\TypeAs\Tests\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Stubs\Objects\ParentClassStub;
use Smpita\TypeAs\TypeAs;

class MixedToClass
{
    public mixed $data;

    public function main(): object
    {
        $this->data = new ChildClassStub();

        $typed = TypeAs::class(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    private function test(ParentClassStub $input): object
    {
        return $input;
    }
}
