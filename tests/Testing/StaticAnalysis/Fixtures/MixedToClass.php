<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ChildClassStub;
use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ParentClassStub;

class MixedToClass
{
    public mixed $data;

    /**
     * @return object
     */
    public function static(): object
    {
        $this->data = new ChildClassStub();

        $typed = \Smpita\TypeAs\TypeAs::class(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    /**
     * @return object
     */
    public function globalHelper(): object
    {
        $this->data = new ChildClassStub();

        $typed = \asClass(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    /**
     * @return object
     */
    public function helper(): object
    {
        $this->data = new ChildClassStub();

        $typed = \Smpita\TypeAs\asClass(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    /**
     * @return object
     */
    public function fluent(): object
    {
        $this->data = new ChildClassStub();

        $typed = \type($this->data)->asClass(ParentClassStub::class);

        return $this->test($typed);
    }

    /**
     * @param ParentClassStub $input
     * @return object
     */
    private function test(ParentClassStub $input): object
    {
        return $input;
    }
}
