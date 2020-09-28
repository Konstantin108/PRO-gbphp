<?php
namespace app\repositories;
use app\entities\Entity;
use app\services\DB;

abstract class Repository
{
    abstract protected function getTableName():string;
    abstract protected function getEntityName():string;

    protected static function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id ";
        $params = [':id' => $id];
        return static::getDB()->getObject($sql, $this->getEntityName(), $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDB()->getAllObjects($sql, $this->getEntityName());
    }

    protected function insert(Entity $entity)
    {
        $fields = [];
        $params = [];
        foreach ($entity as $fieldName => $value){      //<-- Получение всех столбцов из таблицы
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
        static::getDB()->execute($sql, $params);
        $entity->id = static::getDB()->getLastId();
        return $entity;
    }

    protected function update(Entity $entity)
    {
                $fields = [];
                $params = [];
                $goodsId = [];
                foreach ($entity as $fieldName => $value){
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
                static::getDB()->execute($sql, $params);
                return $entity;

    }

    public function save(Entity $entity)
    {
        if(empty($entity->id)){
            $this->insert($entity);
            return;
        }
        $this->update($entity);
    }

    public function delete(Entity $entity)
    {
           $sql = sprintf(
               "DELETE FROM %s WHERE id = %s",
               $this->getTableName(),
               $entity->id                                   //$entity вместо $this
           );
           static::getDB()->execute($sql);
    }

}