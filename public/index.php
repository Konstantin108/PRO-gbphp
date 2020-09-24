<?php
use app\services\Autoload;

include dirname(__DIR__) . "/services/Autoload.php";      //<-- регистрация класса Autoload
spl_autoload_register([(new Autoload()), 'load']);

$controllerName = 'user';      //<-- создание контроллера
if(!empty(trim($_GET['c']))){
    $controllerName = trim($_GET['c']);
}

$actionName = '';
if(!empty(trim($_GET['a']))){
    $actionName = trim($_GET['a']);
}

$controllerClass = 'app\\controllers\\' . ucfirst($controllerName) . 'Controller';


if(class_exists($controllerClass)){
    /**
    *$var \app\controllers\UserController $controller
    */
    $controller = new $controllerClass();
    echo $controller->run($actionName);
}else{
    echo '404';
}

//------------- метод update -------------//


//$user = new \app\models\User();      <-- Добавление строки в таблицу users или её изменение
//$user->name = 'John';
//$user->login = 'user6';
//$user->password = '1236';
//$user->is_admin = 0;
//$user->id = '364';
//$user->position = 'developer';

//$user->save();


//------------- метод delete -------------//

//$user = new \app\models\User();      <-- Удаление строки
//$user->id = '364';
//$user->delete();