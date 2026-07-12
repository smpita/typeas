<?php

namespace Smpita\TypeAs\Concerns;

use InvalidArgumentException;
use Smpita\TypeAs\Contracts\TypeAsResolver;
use Smpita\TypeAs\Exceptions\TypeAsResolutionException;

trait ThrowsTypeAsResolutionExceptions
{
    /**
     * @var class-string<TypeAsResolutionException>|null
     */
    protected ?string $throwException = null;

    protected ?string $throwMessage = null;

    /**
     * @throws TypeAsResolutionException
     */
    protected function throwResolutionException(mixed $value, TypeAsResolver $resolver): never
    {
        $type = is_object($value) ? get_class($value) : gettype($value);
        $classname = basename(str_replace('\\', '/', $resolver::class));

        $message = sprintf($this->getThrowMessage(), $type, $classname);
        $exception = $this->getThrowException();

        if (is_a($exception, TypeAsResolutionException::class, true)) {
            throw new $exception($message);
        }

        throw new TypeAsResolutionException($message);
    }

    public function getThrowMessage(): string
    {
        return $this->throwMessage ?? 'Resolution error converting %s [%s]';
    }

    /**
     * @return class-string<TypeAsResolutionException>
     */
    public function getThrowException(): string
    {
        return $this->throwException ?? TypeAsResolutionException::class;
    }

    public function setThrowMessage(?string $message = null): self
    {
        $this->throwMessage = $message;

        return $this;
    }

    public function setThrowException(?string $exception = null): self
    {
        match (true) {
            is_null($exception) => $this->throwException = null,
            is_a($exception, TypeAsResolutionException::class, true) => $this->throwException = $exception,
            default => throw new InvalidArgumentException("Must extend TypeAsResolutionException: $exception"),
        };

        return $this;
    }
}
