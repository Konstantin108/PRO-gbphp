<?php
namespace app\models;

use app\services\DB;

abstract class Model
{
    //protected $db;
    //protected $tableName;

    abstract protected function getTableName():string;

    //public function __construct(DB $db)
    //{
    //    $this->db = $db;
    //}

    protected function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id ";
        $params = [':id' => $id];
        return $this->getDB()->find($sql, $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDB()->findAll($sql);
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}