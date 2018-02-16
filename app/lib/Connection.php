<?php

namespace base\lib;

use PDO;

class Connection
{
    private static $instance;
    private $pdoObject;

    private function __construct()
    {
        $envDSN = getenv('DATABASE_URL');
        $user = getenv('DATABASE_USERNAME');
        $password = getenv('DATABASE_PASSWORD');
        try
        {
            $this->pdoObject = new PDO($envDSN, $user, $password);
        }
        catch (\Exception $e)
        {
          echo 'Error '.$e->getMessage();
        }

        $this->pdoObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function pdo()
    {
        return $this->pdoObject;
    }

    public static function getConnection()
    {
        if (static::$instance === null)
        {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function __clone()
    {
        return false;
    }
    public function __wakeup()
    {
        return false;
    }
}