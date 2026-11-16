<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

use Smpita\TypeAs\Tests\Testing\Stubs\Objects\ParentClassStub;

class MixedToNullableClass
{
    public mixed $data = null;

    /**
     * @return object|null
     */
    public function static(): ?object
    {
        $typed = \Smpita\TypeAs\TypeAs::nullableClass(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    /**
     * @return object|null
     */
    public function globalHelper(): ?object
    {
        $typed = \asNullableClass(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    /**
     * @return object|null
     */
    public function helper(): ?object
    {
        $typed = \Smpita\TypeAs\asNullableClass(ParentClassStub::class, $this->data);

        return $this->test($typed);
    }

    /**
     * @return object|null
     */
    public function fluent(): ?object
    {
        $typed = \type($this->data)->nullable()->asClass(ParentClassStub::class);

        return $this->test($typed);
    }

    /**
     * @param ParentClassStub|null $input
     * @return object|null
     */
    private function test(?object $input): ?object
    {
        return $input;
    }
}
