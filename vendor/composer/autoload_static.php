<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd92192f8e11f8a16a17ba9c4610ade16
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Exercise\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Exercise\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd92192f8e11f8a16a17ba9c4610ade16::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd92192f8e11f8a16a17ba9c4610ade16::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
