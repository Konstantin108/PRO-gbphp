<?php
namespace app\models;

use app\services\DB;

abstract class Model
{
    protected $db;
    protected $tableName;

    abstract protected function getTableName():string;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id ";
        $params = [':id' => $id];
        return $this->db->find($sql, $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->findAll($sql);
    }
}