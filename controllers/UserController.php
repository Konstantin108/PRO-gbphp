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
        return $this->render('userOne', ['user' => $person]);
    }

    public function updateUserAction()
    {
        $id = $this->getId();
        $person = User::getOne($id);
        return $this->render('userUpdate', ['user' => $person]);
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

        if(!empty($is_admin)){
            $nowStat = $is_admin;
        }else{}

        switch($is_admin){
                    case 'yes':
                        $is_admin = 2;
                        break;
                    case 'no';
                        $is_admin = 3;
                        break;
                    default:
                        $is_admin = $is_admin;
                        break;
                }

        $user->is_admin = $is_admin;
        if(!empty($login) &&
            !empty($name) &&
            !empty($password) &&
            !empty($position) &&
            !empty($is_admin)){
            $user->save();
            return $this->render('userUpdated');
        }else{
            return $this->render('emptyFields');
        }
    }

    public function delUserAction()
    {
            $id = $this->getId();
            $person = User::getOne($id);
            return $this->render('userDel', ['user' => $person]);
    }

    public function getDelUserAction()
    {
        $id = $_POST['idForDel'];
        $user = new \app\models\User();
        $user->id = $id;
        $user->delete();

        return $this->render('userDeleted');
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
                        'layouts/main',
                        [
                            'content' => $content
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