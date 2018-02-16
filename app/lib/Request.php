<?php

namespace base\lib;

class Request
{
    public static $defaultController = 'Index';

    public static function get()
    {
        return $_GET;
    }

    public static function post()
    {
        return $_POST;
    }

    public static function request()
    {
        return static::class;
    }

    public static function isGet()
    {
        return (static::get() !== null);
    }

    public static function isPost()
    {
        return (static::post() !== null);
    }

    public static function getURI()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public static function toController($url = null)
    {
        $pathExploded = explode('/', $url);
        $baseController = null;
        $actionController = null;

        $baseController = $pathExploded[1];
        if (count($pathExploded) > 1) {
            $actionController = $pathExploded[2];
        }

        if (empty($baseController)) {
            $baseController = static::$defaultController;
        }

        return ['base' => ucfirst(strtolower($baseController)), 'action' => $actionController];
    }
}