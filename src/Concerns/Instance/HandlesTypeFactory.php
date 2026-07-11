<?php

namespace Smpita\TypeAs\Concerns\Instance;

use Smpita\TypeAs\Exceptions\TypeAsResolutionException;
use Smpita\TypeAs\TypeFactory;

trait HandlesTypeFactory
{
    protected static TypeFactory $instance;

    public static function useDefaultResolvers(): void
    {
        static::getInstance()->useDefaultResolvers();
    }

    public static function getInstance(): TypeFactory
    {
        return static::$instance ??= new TypeFactory();
    }

    /**
     * @param class-string<TypeAsResolutionException>|null $exception
     */
    public static function onError(?string $message = null, ?string $exception = null): TypeFactory
    {
        return static::getInstance()
            ->setThrowMessage($message)
            ->setThrowException($exception);
    }
}
