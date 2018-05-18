<?php

namespace BlogPHP\App;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $class = str_replace('BlogPHP', '', $class);
        $class = str_replace('\\', '/', $class);
        require dirname(__DIR__).$class.'.php';
    }
}
