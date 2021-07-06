<?php

namespace app\controllers;

use app\entities\Order;
use app\repositories\OrderRepository;

class OrderController extends Controller
{

    public function allAction()
    {
        $orders = (new OrderRepository())->getAll();   //<--изменение для репозиториев и сущностей
        return $this->renderer->render('orderAll', ['orders' => $orders]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = (new OrderRepository())->getOne($id);   //<--изменение для репозиториев и сущностей
        return $this->renderer->render('orderOne',
            [
                'order' => $person,
                'title' => $person->login
            ]
        );
    }

    public function delOrderAction()
    {
        $id = $this->getId();
        $person = (new OrderRepository())->getOne($id);   //<--изменение для репозиториев и сущностей
        return $this->renderer->render('orderDel',
            [
                'order' => $person,
                'title' => 'Удаление'
            ]
        );
    }

    public function getDelOrderAction()
    {
        $id = $_POST['idForDel'];
        $order = new Order();   //<--изменение для репозиториев и сущностей
        $order->id = $id;
        (new OrderRepository())->delete($order);   //<--изменение для репозиториев и сущностей
        header('Location: /order/all');   //<--путь изменён для twig
        return '';
    }

}