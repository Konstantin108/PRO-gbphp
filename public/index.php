<?php
include dirname(__DIR__) . '/vendor/autoload.php';
$config = include dirname(__DIR__) . '/main/config.php';      //<-- В config записываются
\app\main\App::call()->run($config);

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