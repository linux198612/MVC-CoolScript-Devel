<?php
namespace System\Helpers;

class Config
{
    private static $config = [];
    
    public static function get($key, $default = null)
    {
        if (empty(self::$config)) {
            self::$config = require __DIR__ . '/../../App/Config/settings.php';
        }
        
        return self::$config[$key] ?? $default;
    }
    
    public static function set($key, $value)
    {
        self::$config[$key] = $value;
    }
}
