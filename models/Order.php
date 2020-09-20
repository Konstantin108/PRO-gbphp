<?php
namespace app\models;

class Order extends Model
{

    public $id;
    public $id_user;
    public $count;
    public $total;

    protected function getTableName():string
    {
        return 'order';
    }
}