<?php

namespace app\models\test;

use app\models\Model;

class GoodTest extends Model
{

    public $id;
    public $name;
    public $price;
    public $info;

    protected function getTableName(): string
    {
        return 'goodsTest';
    }

    public function fetAll()
    {
        return parent::getAll();
    }
}