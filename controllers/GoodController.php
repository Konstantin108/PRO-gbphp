<?php

namespace app\controllers;

use app\entities\Good;

class GoodController extends Controller
{
    public function allAction()
    {
        $goods = $this->container->goodRepository->getAll();
        return $this->render('goodAll',
            [
                'goods' => $goods,
            ]
        );
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = $this->container->goodRepository->getOne($id);
        return $this->render('goodOne',
            [
                'good' => $good,
            ]
        );
    }

    public function updateGoodAction()
    {
        $id = $this->getId();
        $good = $this->container->goodRepository->getOne($id);
        return $this->render('goodUpdate',
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
        $img = $_POST['img'];

        $counter = 1;

        $good = new Good();
        $good->id = $id;
        $good->name = $name;
        $good->price = $price;
        $good->info = $info;
        $good->img = $img;
        $good->counter = $counter;

        if (!empty($name) && !empty($price) && !empty($info) && !empty($counter)) {
            $this->container->goodRepository->save($good);
            header('Location: /good/all');   //<--путь изменён для twig
            return '';

        } else {
            return $this->render('emptyFields');
        }
    }

    public function delGoodAction()
    {
        $id = $this->getId();
        $good = $this->container->goodRepository->getOne($id);
        return $this->render('goodDel',
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