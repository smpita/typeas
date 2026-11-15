<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToNullableString
{
    public mixed $data = null;

    /**
     * @return string|null
     */
    public function static(): ?string
    {
        $typed = \Smpita\TypeAs\TypeAs::nullableString($this->data);

        return $this->test($typed);
    }

    /**
     * @return string|null
     */
    public function globalHelper(): ?string
    {
        $typed = \asNullableString($this->data);

        return $this->test($typed);
    }

    /**
     * @return string|null
     */
    public function helper(): ?string
    {
        $typed = \Smpita\TypeAs\asNullableString($this->data);

        return $this->test($typed);
    }

    /**
     * @return string|null
     */
    public function fluent(): ?string
    {
        $typed = \type($this->data)->nullable()->asString();

        return $this->test($typed);
    }

    /**
     * @param string|null $input
     * @return string|null
     */
    private function test(?string $input): ?string
    {
        return $input;
    }
}
