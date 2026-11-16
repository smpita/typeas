<?php

declare(strict_types=1);

namespace Smpita\TypeAs\Tests\Testing\StaticAnalysis\Fixtures;

class MixedToString
{
    public mixed $data = 0;

    /**
     * @return string
     */
    public function static(): string
    {
        $typed = \Smpita\TypeAs\TypeAs::string($this->data);

        return $this->test($typed);
    }

    /**
     * @return string
     */
    public function globalHelper(): string
    {
        $typed = \asString($this->data);

        return $this->test($typed);
    }

    /**
     * @return string
     */
    public function helper(): string
    {
        $typed = \Smpita\TypeAs\asString($this->data);

        return $this->test($typed);
    }

    /**
     * @return string
     */
    public function fluent(): string
    {
        $typed = \type($this->data)->asString();

        return $this->test($typed);
    }

    /**
     * @param string $input
     * @return string
     */
    private function test(string $input): string
    {
        return $input;
    }
}
