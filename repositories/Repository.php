<?php

namespace app\repositories;

use app\entities\Entity;
use app\main\Container;

abstract class Repository
{

    protected $container;

    abstract protected function getTableName(): string;

    abstract protected function getEntityName(): string;

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    protected function getDB()
    {
        return $this->container->db;
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id ";
        $params = [':id' => $id];
        return $this->getDB()->getObject($sql, $this->getEntityName(), $params);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->getDB()->getAllObjects($sql, $this->getEntityName());
    }

    protected function insert(Entity $entity)
    {
        $fields = [];
        $params = [];
        foreach ($entity as $fieldName => $value) {      //<-- Получение всех столбцов из таблицы
            if ($fieldName == 'id') {
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
        return $this->getDB()->execute($sql, $params);
        $entity->id = $this->getDB()->getLastId();
        return $entity;
    }

    protected function update(Entity $entity)
    {
        $fields = [];
        $params = [];
        $goodsId = [];
        foreach ($entity as $fieldName => $value) {
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
            $this->getTableName(),
            $string,
            $shiftFields
        );
        return $this->getDB()->execute($sql, $params);
        return $entity;

    }

    public function save(Entity $entity)
    {
        if (empty($entity->id)) {
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
        return $this->getDB()->execute($sql);
    }

}