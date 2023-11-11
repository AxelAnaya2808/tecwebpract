<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit3b0564b4ed80b6368be51e0ef306181e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit3b0564b4ed80b6368be51e0ef306181e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit3b0564b4ed80b6368be51e0ef306181e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInit3b0564b4ed80b6368be51e0ef306181e::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
