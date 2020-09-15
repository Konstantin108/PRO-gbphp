<?php
namespace app\services;

class DB
{
    private $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'db' => 'gbphp',
        'charset' => 'UTF8',
        'login' => 'root',
        'password' => 'root'
    ];

    private $connection;

    public function getConnection()
    {
        if (empty($this->connection)){
            $this->connection = new \PDO(
            $this->getSdn(),
            $this->config['login'],
            $this->config['password']
            );
            $this->connection->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }
        return $this->connection;
    }

    private function getSdn()
    {
        return sprintf (
            "%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['db'],
            $this->config['charset']
        );
    }

    public function find($sql, $params)
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement->fetch();
    }

    public function findAll($sql)
    {

        return 'findAll ' . $sql;
    }
}
