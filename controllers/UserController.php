<?php

namespace app\controllers;

use app\entities\User;
use app\repositories\UserRepository;

class UserController extends Controller
{

    public function allAction()
    {
        $users = (new UserRepository())->getAll();   //<--изменение для репозиториев и сущностей
        return $this->renderer->render('userAll', ['users' => $users]);
    }

    public function oneAction()
    {
        $id = $this->getId();
        $person = (new UserRepository())->getOne($id);   //<--изменение для репозиториев и сущностей
        return $this->renderer->render('userOne',
                        [
                            'user' => $person,
                            'title' => $person->login
                        ]
                     );
    }

    public function updateUserAction()
    {
        $id = $this->getId();
        $person = (new UserRepository())->getOne($id);   //<--изменение для репозиториев и сущностей
        return $this->renderer->render('userUpdate',
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

        $user = new User();   //<--изменение для репозиториев и сущностей
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
            (new UserRepository())->save($user);   //<--изменение для репозиториев и сущностей
            header('Location: /user/all');   //<--путь изменён для twig
            return '';
        }else{
            return $this->renderer->render('emptyFields',
                              [
                                  'title' => 'Ошибка редактирования'
                              ]
                           );
        }
    }

    public function delUserAction()
    {
            $id = $this->getId();
            $person = (new UserRepository())->getOne($id);   //<--изменение для репозиториев и сущностей
            return $this->renderer->render('userDel',
                             [
                                'user' => $person,
                                'title' => 'Удаление'
                             ]
                         );
    }

    public function getDelUserAction()
    {
        $id = $_POST['idForDel'];
        $user = new User();   //<--изменение для репозиториев и сущностей
        $user->id = $id;
        (new UserRepository())->delete($user);   //<--изменение для репозиториев и сущностей
        header('Location: /user/all');   //<--путь изменён для twig
        return '';
    }

}