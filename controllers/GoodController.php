<?php

namespace app\controllers;

use app\entities\Good;
use app\repositories\GoodRepository;

class GoodController extends Controller
{
    public function allAction()
    {
        $goods = (new GoodRepository())->getAll();
        return $this->renderer->render('goodAll',
                                    [
                                        'goods' => $goods,
                                        'title' => 'Список товаров'
                                    ]
                                 );
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = (new GoodRepository())->getOne($id);
        return $this->renderer->render('goodOne',
                        [
                            'good' => $good,
                            'title' => $good->name
                        ]
                     );
    }

    public function updateGoodAction()
    {
        $id = $this->getId();
        $good = (new GoodRepository())->getOne($id);
        return $this->renderer->render('goodUpdate',
                        [
                            'good' => $good,
                            'title' => 'Редактирование ' . $good->name
                        ]
                     );
    }

    public function getUpdateGoodAction()
    {
            $id = $_POST['idForUpdate'];
            $name = $_POST['nameForUpdate'];
            $price = $_POST['priceForUpdate'];
            $info = $_POST['infoForUpdate'];

            $counter = 1;

            $good = new Good();
            $good->id = $id;
            $good->name = $name;
            $good->price = $price;
            $good->info = $info;
            $good->counter = $counter;

            if(!empty($name) && !empty($price) && !empty($info) && !empty($counter)){
                (new GoodRepository())->save($good);
                header('Location: /good/all');   //<--путь изменён для twig
                return '';

            }else{
                return $this->renderer->render('emptyFields',
                                  [
                                      'title' => 'Ошибка редактирования'
                                  ]
                               );
            }
    }

    public function delGoodAction()
    {
                $id = $this->getId();
                $good = (new GoodRepository())->getOne($id);
                return $this->renderer->render('goodDel',
                                 [
                                    'good' => $good,
                                    'title' => 'Удаление'
                                 ]
                             );
    }

    public function getDelGoodAction()
    {
            $id = $_POST['idForDel'];
            $good = new Good();
            $good->id = $id;
            (new GoodRepository())->delete($good);
            header('Location: /good/all');   //<--путь изменён для twig
            return '';
    }

}