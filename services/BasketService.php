<?php

namespace app\services;

use app\entities\Good;
use app\repositories\GoodRepository;

class BasketService
{
    const BASKET_NAME = 'goods';

    public function add($id, GoodRepository $goodRepository, Request $request)
    {
        if(empty($id)){
                    return 'нет id';
               }
               $good = $goodRepository->getOne($id);
               if(empty($id)){
                    return 'нет товара';
               }

                $goods = $request->getSession(self::BASKET_NAME);

               if(empty($goods[$id])){
                    $goods[$id] = [
                        'name' => $good->name,
                        'count' => 1,
                        'price' => $good->price
                    ];

                    $request->setSession(self::BASKET_NAME, $goods);
                    return 'товар добавлен';
               }
               $goods[$id]['count']++;
               $request->setSession(self::BASKET_NAME, $goods);
               return 'товар добавлен';
    }
}