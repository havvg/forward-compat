<?php

namespace Havvg\ForwardCompat\Autoloader;

final class AliasFromPear
{
    public static function createAlias($pear)
    {
        $psr = str_replace('_', '\\', $pear);

        if (!class_exists($pear) && class_exists($psr)) {
            class_alias($psr, $pear);
        }

        if (!interface_exists($pear) && interface_exists($psr)) {
            class_alias($psr, $pear);
        }

        if (!trait_exists($pear) && trait_exists($psr)) {
            class_alias($psr, $pear);
        }
    }
}
