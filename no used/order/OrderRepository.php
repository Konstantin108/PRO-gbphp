<?php

namespace app\repositories;

use app\entities\Order;

class OrderRepository extends Repository
{
    protected function getTableName() :string
    {
        return 'orders';
    }

    protected function getEntityName() :string
    {
        return Order::class;
    }

}