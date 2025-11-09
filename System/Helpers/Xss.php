<?php
namespace System\Helpers;

class Xss
{
    /**
     * Escape output for safe HTML rendering.
     * @param string $value
     * @return string
     */
    public static function escape($value)
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
