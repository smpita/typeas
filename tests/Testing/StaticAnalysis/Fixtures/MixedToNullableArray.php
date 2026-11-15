<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToNullableArray
{
    public mixed $data = null;

    /**
     * @return array<mixed>|null
     */
    public function static(): ?array
    {
        $typed = \Smpita\TypeAs\TypeAs::nullableArray($this->data);

        return $this->test($typed);
    }

    /**
     * @return array<mixed>|null
     */
    public function globalHelper(): ?array
    {
        $typed = \asNullableArray($this->data);

        return $this->test($typed);
    }

    /**
     * @return array<mixed>|null
     */
    public function helper(): ?array
    {
        $typed = \Smpita\TypeAs\asNullableArray($this->data);

        return $this->test($typed);
    }

    /**
     * @return array<mixed>|null
     */
    public function fluent(): ?array
    {
        $typed = \type($this->data)->nullable()->asArray();

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
