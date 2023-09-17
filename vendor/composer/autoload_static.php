<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc70834b422bbe9b59dd53905050feaa8
{
    public static $files = array (
        '0d4507a35308200d41425eaae4b516fa' => __DIR__ . '/..' . '/youniwemi/wp-settings-kit/class-wp-settings-kit.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'Youniwemi\\StringTemplate\\' => 25,
        ),
        'O' => 
        array (
            'Orhanerday\\OpenAi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Youniwemi\\StringTemplate\\' => 
        array (
            0 => __DIR__ . '/..' . '/youniwemi/string-template/src/StringTemplate',
        ),
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
