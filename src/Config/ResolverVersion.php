<?php

namespace Smpita\TypeAs\Config;

use Smpita\TypeAs\Config\Definitions\V4;
use Smpita\TypeAs\Config\Definitions\V5;
use Smpita\TypeAs\Contracts\ResolverConfigDefinition;
use Smpita\TypeAs\Data\ResolverConfig;
use Smpita\TypeAs\TypeAs;

enum ResolverVersion: string
{
    case V5 = V5::class;
    case V4 = V4::class;

    public static function default(): self
    {
        return self::V5;
    }

    /**
     * @return class-string<ResolverConfigDefinition>
     */
    public function definition(): string
    {
        return $this->value;
    }

    public function config(): ResolverConfig
    {
        return $this->definition()::config();
    }

    public function setResolvers(): void
    {
        $this->setArrayResolver();
        $this->setBoolResolver();
        $this->setClassResolver();
        $this->setFilterBoolResolver();
        $this->setFloatResolver();
        $this->setIntResolver();
        $this->setStringResolver();
    }

    public function setArrayResolver(): void
    {
        $resolver = $this->config()->arrayResolver();

        TypeAs::setArrayResolver($resolver);
    }

    public function setBoolResolver(): void
    {
        $resolver = $this->config()->boolResolver();

        TypeAs::setBoolResolver($resolver);
    }

    public function setClassResolver(): void
    {
        $resolver = $this->config()->classResolver();

        TypeAs::setClassResolver($resolver);
    }

    public function setFilterBoolResolver(): void
    {
        $resolver = $this->config()->filterBoolResolver();

        TypeAs::setFilterBoolResolver($resolver);
    }

    public function setFloatResolver(): void
    {
        $resolver = $this->config()->floatResolver();

        TypeAs::setFloatResolver($resolver);
    }

    public function setIntResolver(): void
    {
        $resolver = $this->config()->intResolver();

        TypeAs::setIntResolver($resolver);
    }

    public function setStringResolver(): void
    {
        $resolver = $this->config()->stringResolver();

        TypeAs::setStringResolver($resolver);
    }
}
