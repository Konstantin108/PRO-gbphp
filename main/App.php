<?php

namespace app\main;

use app\traits\SingletonTrait;

class App
{
    use SingletonTrait;

    protected $config;
    protected $container;

    public static function call()
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->container = new Container($config['components']);
        $this->config = $config;
        $this->runController();
    }

    private function runController()
    {
        $request = new \app\services\Request();

        //new \Twig\Loader\FilesystemLoader();

        //include dirname(__DIR__) . "/services/Autoload.php";      <-- регистрация класса Autoload
        //spl_autoload_register([(new Autoload()), 'load']);

        $controllerName = 'good';      //<-- настройка контроллера
        if(!empty($request->getActionName())){
            $controllerName = $request->getControllerName();
        }

        $controllerClass = 'app\\controllers\\' . ucfirst($controllerName) . 'Controller';

        if(class_exists($controllerClass)){
            $renderer = new \app\services\TwigRenderServices();
            $controller = new $controllerClass($request, $this->container);
            echo $controller->run($request->getActionName());
        }else{
            echo '404';
        }
    }
}