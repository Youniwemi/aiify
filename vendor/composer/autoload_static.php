<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc70834b422bbe9b59dd53905050feaa8
{
    public static $files = array (
        'cfb03dbdb221e442e2d454763906fa48' => __DIR__ . '/..' . '/ahmadawais/wp-oop-settings-api/class-wp-osa.php',
    );

    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Orhanerday\\OpenAi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Orhanerday\\OpenAi\\' => 
        array (
            0 => __DIR__ . '/..' . '/orhanerday/open-ai/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc70834b422bbe9b59dd53905050feaa8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc70834b422bbe9b59dd53905050feaa8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc70834b422bbe9b59dd53905050feaa8::$classMap;

        }, null, ClassLoader::class);
    }
}
