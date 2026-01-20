<?php

namespace Smpita\TypeAs\Concerns\Instance;

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
}
