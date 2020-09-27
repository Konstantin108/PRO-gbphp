<?php

namespace app\controllers;
use app\models\User;

class UserController
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
        $users = User::getAll();
        return $this->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = User::getOne($id);
        return $this->render('userOne',
                        [
                            'user' => $person,
                            'title' => $person->login
                        ]
                     );
    }

    public function updateUserAction()
    {
        $id = $this->getId();
        $person = User::getOne($id);
        return $this->render('userUpdate',
                        [
                            'user' => $person,
                            'title' => 'Редактирование ' . $person->login
                        ]
                     );
    }

    public function getUpdateUserAction()
    {
        $id = $_POST['idForUpdate'];
        $login = $_POST['loginForUpdate'];
        $name = $_POST['nameForUpdate'];
        $password = $_POST['passwordForUpdate'];
        $position = $_POST['positionForUpdate'];

        $is_admin = $_POST['adminStat'];

        $user = new \app\models\User();
        $user->id = $id;
        $user->login = $login;
        $user->name = $name;
        $user->password = $password;
        $user->position = $position;

        switch($is_admin){
                    case 'yes':
                        $is_admin = 2;
                        break;
                    case 'no';
                        $is_admin = 0;
                        break;
                    default:
                        $is_admin = 0;
                        break;
                }

        $user->is_admin = $is_admin;
        if(!empty($login) && !empty($name) && !empty($password) && !empty($position)){
            $user->save();
            return $this->render('userUpdated',
                              [
                                  'title' => 'Данные обновлены'
                              ]
                           );
        }else{
            return $this->render('emptyFields',
                              [
                                  'title' => 'Ошибка редактирования'
                              ]
                           );
        }
    }

    public function delUserAction()
    {
            $id = $this->getId();
            $person = User::getOne($id);
            return $this->render('userDel',
                             [
                                'user' => $person,
                                'title' => 'Удаление'
                             ]
                         );
    }

    public function getDelUserAction()
    {
        $id = $_POST['idForDel'];
        $user = new \app\models\User();
        $user->id = $id;
        $user->delete();

        return $this->render('userDeleted',
                         [
                             'title' => 'Пользователь удалён'
                         ]
                      );
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);

        $title = 'Мой магазин';
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