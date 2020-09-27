<?php

namespace app\controllers;
use app\models\Good;

class GoodController extends Controller
{
    public function allAction()
    {
        $goods = Good::getAll();
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
        $good = Good::getOne($id);
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
        $good = Good::getOne($id);
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

            $good = new \app\models\Good();
            $good->id = $id;
            $good->name = $name;
            $good->price = $price;
            $good->info = $info;
            $good->counter = $counter;

            if(!empty($name) && !empty($price) && !empty($info) && !empty($counter)){
                $good->save();
                header('Location: /?c=good&a=all');
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
                $good = Good::getOne($id);
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
            $good = new \app\models\Good();
            $good->id = $id;
            $good->delete();
            header('Location: /?c=good&a=all');
            return '';
    }

}