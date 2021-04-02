<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit68d0feb13e30e027cce57f53181166fe
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit68d0feb13e30e027cce57f53181166fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit68d0feb13e30e027cce57f53181166fe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit68d0feb13e30e027cce57f53181166fe::$classMap;

        }, null, ClassLoader::class);
    }
}
