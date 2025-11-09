<?php
namespace System\Helpers;

class Request
{
    /**
     * Get a value from $_GET, with optional default.
     */
    public static function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    /**
     * Get a value from $_POST, with optional default.
     */
    public static function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    /**
     * Get a value from $_REQUEST, with optional default.
     */
    public static function input($key, $default = null)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    /**
     * Get all $_GET parameters.
     */
    public static function allGet()
    {
        return $_GET;
    }

    /**
     * Get all $_POST parameters.
     */
    public static function allPost()
    {
        return $_POST;
    }

    /**
     * Get all $_REQUEST parameters.
     */
    public static function all()
    {
        return $_REQUEST;
    }

    /**
     * Get request method (GET, POST, etc).
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * Check if request is AJAX.
     */
    public static function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Get raw request body.
     */
    public static function raw()
    {
        return file_get_contents('php://input');
    }
}
