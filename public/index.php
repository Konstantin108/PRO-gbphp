<?php
use app\services\Autoload;

use \app\models\Good;
use \app\models\User;

include dirname(__DIR__) . "/services/Autoload.php";      //<-- регистрация класса Autoload
spl_autoload_register([(new Autoload()), 'load']);

//$db = app\services\DB::getInstance();

//$user = new User($db);
//$userModel = $user->getOne(83);      <-- Получение строк по id из таблицы users
//echo '<pre>';
//var_dump($userModel);
//echo '<hr>';
//var_dump($user->getAll());      <-- Получение всех строк из таблицы users
//echo '<hr>';

$user = new \app\models\User();      //<-- Добавление строки в таблицы users
$user->name = 'Мария';
$user->login = 'user8';
$user->password = '1238';
$user->is_admin = 0;
$user->position = 'designer';
$user->save();

$good = new \app\models\Good();      //<-- Добавление строки в таблицы goods
$good->name = 'meizu m3 note';
$good->price = '12990';
$good->info = 'wide screen';
$good->save();

echo '<pre>';
var_dump($good);

//$user = new app\models\User($db);
//echo $user->getOne(12);
//echo '<hr>';
//echo $user->getAll();
//echo '<hr>';
//
//$order = new app\models\Order($db);
//echo $order->getOne(7);
//echo '<hr>';
//echo $order->getAll();
//echo '<hr>';
//
//$goodTest = new app\models\test\GoodTest($db);
//echo $goodTest->getOne(7);
//echo '<hr>';
//echo $goodTest->getAll();
//echo '<hr>';

