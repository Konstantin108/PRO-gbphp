<?php

namespace app\models;

use app\services\DB;

/**
 *Class Model
 * @package app\models
 * @property int id
 **/
abstract class Model
{
    //protected $db;
    //protected $tableName;


    abstract protected static function getTableName(): string;

    //public function __construct(DB $db)
    //{
    //    $this->db = $db;
    //}

    protected static function getDB()
    {
        return DB::getInstance();
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id ";
        $params = [':id' => $id];
        return static::getDB()->getObject($sql, static::class, $params);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDB()->getAllObjects($sql, static::class);
    }

    protected function insert()
    {
        $fields = [];
        $params = [];
        foreach ($this as $fieldName => $value) {      //<-- Получение всех столбцов из таблицы
            if ($fieldName == 'id') {
                continue;
            }
            $fields[] = $fieldName;
            $params[":{$fieldName}"] = $value;
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",      //<-- Заполнение всех столбцов из таблицы
            static::getTableName(),
            implode(',', $fields),
            implode(',', array_keys($params))
        );
        static::getDB()->execute($sql, $params);
        $this->id = static::getDB()->getLastId();
    }

    protected function update()
    {
        $fields = [];
        $params = [];
        $goodsId = [];
        foreach ($this as $fieldName => $value) {
            $fields[] = $fieldName;
            $params[":{$fieldName}"] = $value;
        }

        foreach ($fields as $value) {
            $fixFields[] = $value = $value . ' = :' . $value;
        }
        $shiftFields = array_shift($fixFields);
        $string = implode(', ', $fixFields);

        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s",      //<-- Заполнение всех столбцов из таблицы
            static::getTableName(),
            $string,
            $shiftFields
        );
        static::getDB()->execute($sql, $params);

    }

    public function save()
    {
        if (empty($this->id)) {
            $this->insert();
            return;
        }
        $this->update();
    }

    public function delete()
    {
        $sql = sprintf(
            "DELETE FROM %s WHERE id = %s",
            static::getTableName(),
            $this->id
        );
        static::getDB()->execute($sql);
    }

}