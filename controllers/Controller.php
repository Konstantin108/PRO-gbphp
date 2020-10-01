<?php

namespace app\controllers;

use app\main\Container;
use app\services\RenderServices;
use app\services\Request;
use app\services\RenderI;

abstract class Controller
{
    protected $actionDefault = 'all';
    /*
    *   @var RenderServices
    */
    protected $renderer;

    protected $request;

    protected $container;

    /**
    *   Controller constructor.
    *   @param $renderer
    */
    public function __construct(RenderI $renderer, Request $request, Container $container)
    {
        $this->container = $container;
        $this->renderer = $renderer;
        $this->request = $request;
    }

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


        protected function getId()      //<-- получение id
        {
            return $this->request->getId();
        }

        protected function redirect($path = '', $msg = '')
        {
            if(!empty($msg)){
                $_SESSION['msg'] = $msg;
            }
            if(empty($path)){
                if(empty($_SERVER['HTTP_REFERER'])){
                    $path = '/';
                }else{
                    $path = $_SERVER['HTTP_REFERER'];
                }
            }
            header('Location: ' . $path);
            return '';
        }
}