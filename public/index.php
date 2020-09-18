<?php
use app\services\Autoload;

use \app\models\Good;

include dirname(__DIR__) . "/services/Autoload.php";      //<-- регистрация класса Autoload
spl_autoload_register([(new Autoload()), 'load']);

$db = app\services\DB::getInstance();

$good = new Good($db);
$goodModel = $good->getOne(46);
echo '<pre>';
var_dump($goodModel);
echo '<hr>';
var_dump($good->getAll());
echo '<hr>';

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

