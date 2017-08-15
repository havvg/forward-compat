<?php

namespace Havvg\ForwardCompat\Tests\Cases\Autoloader;

use Havvg\ForwardCompat\Autoloader\AliasFromPear;
use Havvg\ForwardCompat\Autoloader\Autoloader;
use Havvg\ForwardCompat\Tests\Fixtures\LoadableClass;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Havvg\ForwardCompat\Autoloader\Autoloader
 */
final class AutoloaderTest extends TestCase
{
    protected function setUp()
    {
        spl_autoload_unregister([AliasFromPear::class, 'createAlias']);
    }

    public function test_it_aliases_class_from_pear()
    {
        $pear = 'Havvg_ForwardCompat_Tests_Fixtures_LoadableClass';
        self::assertFalse(class_exists($pear));

        Autoloader::registerAliasFromPear();
        self::assertTrue(class_exists($pear));

        $instance = new $pear;
        self::assertInstanceOf(LoadableClass::class, $instance);
    }

    public function test_it_aliases_interface_from_pear()
    {
        $pear = 'Havvg_ForwardCompat_Tests_Fixtures_ExistingInterface';
        self::assertFalse(interface_exists($pear));

        Autoloader::registerAliasFromPear();
        self::assertTrue(interface_exists($pear));
    }

    public function test_it_aliases_trait_from_pear()
    {
        $pear = 'Havvg_ForwardCompat_Tests_Fixtures_ExistingTrait';
        self::assertFalse(trait_exists($pear));

        Autoloader::registerAliasFromPear();
        self::assertTrue(trait_exists($pear));
    }

    public function test_it_does_not_break_with_invalid_class()
    {
        $pear = 'Havvg_ForwardCompat_Tests_Fixtures_InvalidClass';
        self::assertFalse(class_exists($pear));

        Autoloader::registerAliasFromPear();
        self::assertFalse(class_exists($pear));
    }
}
