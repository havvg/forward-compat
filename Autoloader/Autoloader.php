<?php

namespace Havvg\ForwardCompat\Autoloader;

final class Autoloader
{
    public static function registerAliasFromPear()
    {
        spl_autoload_register([AliasFromPear::class, 'createAlias']);
    }
}
