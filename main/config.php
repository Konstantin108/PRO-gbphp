<?php
return [
    'projectName' => 'мой проект',
    'defaultController' => 'good',
    'components' => [
        'db'=> [
            'class' => \app\services\DB::class,
            'config' => [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'db' => 'gbphp',
                'charset' => 'UTF8',
                'login' => 'root',
                'password' => 'root'
            ]
        ],
        'render' => [
            'class' => \app\services\TwigRenderServices::class,
        ],
        'goodRepository' => [
            'class' => \app\repositories\GoodRepository::class,
        ],
        'userRepository' => [
                    'class' => \app\repositories\UserRepository::class,
                ]
    ],
];