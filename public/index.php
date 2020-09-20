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

$user = new \app\models\User();      //<-- Добавление строки в таблицу users
$user->name = 'Курага';
$user->login = 'user5';
$user->password = '1235';
$user->is_admin = 0;
$user->position = 'cat';

$user->save();


//$good = new \app\models\Good();      <-- Добавление строки в таблицу goods
//$good->name = 'xiaomi mi9t';
//$good->price = '26990';
//$good->info = 'super phone';
//$good->id = '50';
//$good->save();

echo '<pre>';
var_dump($user);

//$good = new \app\models\Good();      <-- Удаление строки из таблицы goods
//$good->id = '98';
//$good->delete();

