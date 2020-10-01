<?php

namespace app\controllers;

use app\entities\Good;
use app\repositories\GoodRepository;
use app\services\BasketService;

class BasketController extends Controller
{

    protected $actionDefault = 'index';

    public function indexAction()
    {
        echo '<pre>';
        var_dump($_SESSION);
    }

   public function addAction()
   {
       $id = $this->getId();
       $goodRepository = $this->container->goodRepository;
       $msg = (new BasketService())->add($id, $goodRepository, $this->request);
       return $this->redirect('', $msg);
   }
}
