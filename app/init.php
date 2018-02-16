<?php

use base\lib\Connection;

class Init
{
    private static $db;
    public $request;
    public $nameSpaceControllers = 'base\controllers';

    public function __construct($request)
    {
        static::$db = Connection::getConnection();
        $this->request = $request;
        $this->start();
    }

    public static function getDb()
    {
        return static::$db;
    }

    public function start()
    {
        $get = $this->request::isGet();

        if ($get) {
            $url = $this->request::getURI();
            $prepareApp = $this->request::toController($url);

            $classReflection = new \ReflectionClass($this->nameSpaceControllers.'\\'.$prepareApp['base']);
            $_instance = $classReflection->newInstance();
            if (isset($prepareApp['action'])) {
                $classMethod = new \ReflectionMethod($_instance, $prepareApp['action']);
            }
            if ($this->request::get() != null) {
                $classMethod->invokeArgs($_instance, $this->request::get());
                return;
            }
            $classMethod->invoke($_instance);

        }
    }
}