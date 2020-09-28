<?php

namespace app\controllers;

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

    /**
    *   Controller constructor.
    *   @param $renderer
    */
    public function __construct(RenderI $renderer, Request $request)
    {
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
}