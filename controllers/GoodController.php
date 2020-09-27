<?php

namespace app\controllers;
use app\models\Good;

class GoodController
{
    protected $action;
    protected $actionDefault = 'all';

    public function run($action)
    {

        if(empty($action)){
            $action = $this->actionDefault;
        }

        $action .= "Action";

        if(!method_exists($this, $action)){
            return '404';
        }

        return $this->$action();
    }

    public function allAction()
    {
        $goods = Good::getAll();
        return $this->render('goodAll', ['goods' => $goods]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $good = Good::getOne($id);
        return $this->render('goodOne',
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
        return $this->render('goodUpdate',
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
                return $this->render('emptyFields',
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
                return $this->render('goodDel',
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

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);

        $title = 'Список товаров';
                if(!empty($params['title'])){
                    $title = $params['title'];
                }

        return $this->renderTmpl(
                        'layouts/main',
                        [
                            'content' => $content,
                            'title' => $title
                        ]
                    );
    }

    public function renderTmpl($template, $params = [])
    {
        extract($params);

        ob_start();
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }

    protected function getId()      //<-- получение id
    {
        if(empty($_GET['id'])){
            return 0;
        }
        return (int)$_GET['id'];
    }
}