<?php

namespace app\controllers;

class userController
{
    protected $action;
    protected $actionDefault = 'all';

    public function run($action)
    {
        $this->action = $action;
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
        return 'все пользователи';
    }

    public function oneAction()
    {
        return 'пользователь';
    }
}