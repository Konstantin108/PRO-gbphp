<?php

namespace app\controllers;

use app\entities\Good;
use app\repositories\GoodRepository;

class GoodController extends Controller
{
    public function allAction()
    {
        $goods = $this->container->goodRepository->getAll();
        return $this->renderer->render('goodAll',
                                    [
                                        'goods' => $goods,
                                    ]
                                 );
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = $this->container->goodRepository->getOne($id);
        return $this->renderer->render('goodOne',
                        [
                            'good' => $good,
                        ]
                     );
    }

    public function updateGoodAction()
    {
        $id = $this->getId();
        $good = $this->container->goodRepository->getOne($id);
        return $this->renderer->render('goodUpdate',
                        [
                            'good' => $good,
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
                $this->container->goodRepository->save($good);
                header('Location: /good/all');   //<--путь изменён для twig
                return '';

            }else{
                return $this->renderer->render('emptyFields');
            }
    }

    public function delGoodAction()
    {
                $id = $this->getId();
                $good = $this->container->goodRepository->getOne($id);
                return $this->renderer->render('goodDel',
                                 [
                                    'good' => $good,
                                 ]
                             );
    }

    public function getDelGoodAction()
    {
            $id = $_POST['idForDel'];
            $good = new Good();
            $good->id = $id;
            $this->container->goodRepository->delete($good);
            header('Location: /good/all');   //<--путь изменён для twig
            return '';
    }

}