<?php
namespace System\Helpers;

class Response
{
    /**
     * Send a JSON response and exit.
     * @param mixed $data
     * @param int $status HTTP status code (default: 200)
     */
    public static function json($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }
}
