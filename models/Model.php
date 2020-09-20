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
        return $this->getDB()->getObject($sql, static::class, $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDB()->getAllObjects($sql, static::class);
    }

    protected function insert()
    {
        $fields = [];
        $params = [];
        foreach ($this as $fieldName => $value){      //<-- Получение всех столбцов из таблицы
            if($fieldName == 'id'){
                continue;
            }
            $fields[] = $fieldName;
            $params[":{$fieldName}"] = $value;
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",      //<-- Заполнение всех столбцов из таблицы
            $this->getTableName(),
            implode(',', $fields),
            implode(',', array_keys($params))
        );
        $this->getDB()->execute($sql, $params);
        $this->id = $this->getDB()->getLastId();
    }

    protected function update()
    {
                $fields = [];
                $params = [];
                $goodsId = [];
                foreach ($this as $fieldName => $value){
                    $fields[] = $fieldName;
                    $params[":{$fieldName}"] = $value;
                }

                foreach($fields as $value){
                    $fixFields[] = $value = $value . ' = :' . $value;
                }
                $shiftFields = array_shift($fixFields);
                $string = implode(', ', $fixFields);

                $sql = sprintf(
                    "UPDATE %s SET %s WHERE %s",      //<-- Заполнение всех столбцов из таблицы
                    $this->getTableName(),
                    $string,
                    $shiftFields
                );
                $this->getDB()->execute($sql, $params);

    }

    public function save()
    {
        if(empty($this->id)){
            $this->insert();
            return;
        }
        $this->update();
    }

    public function delete()
    {
           $sql = sprintf(
               "DELETE FROM %s WHERE id = %s",
               $this->getTableName(),
               $this->id
           );
           $this->getDB()->execute($sql, $params);
    }
}