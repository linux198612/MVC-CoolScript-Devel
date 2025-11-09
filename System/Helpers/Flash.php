<?php
namespace System\Helpers;

class Flash
{
    public static function set(string $key, string $message)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['flash'][$key] = $message;
    }
    
    public static function get(string $key): ?string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $message = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $message;
    }
    
    public static function success(string $message)
    {
        self::set('success', $message);
    }
    
    public static function error(string $message)
    {
        self::set('error', $message);
    }
    
    public static function has(string $key): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return isset($_SESSION['flash'][$key]);
    }
}
