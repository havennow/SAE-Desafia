<?php

namespace base\lib;

abstract class Model
{
    /**
     * @var $connection \PDO
     */
    private $connection;

    public function __construct()
    {
        $this->connection = \Init::getDb();
    }

    abstract public function tableName();

    public function select()
    {
      $pdo = $this->connection->pdo();
      $query = $pdo->prepare("SELECT * FROM {$this->tableName()}");
      $query->execute();
      return $query->fetch($pdo::FETCH_OBJ);
    }

}