<?php

namespace app\tests;

use app\repositories\GoodRepository;
use app\entities\Good;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GoodRepositoryTest extends TestCase
{
    public function testPrivateGetTableName()
    {

        $method = new \ReflectionMethod(
                GoodRepository::class,
                'getTableName'
        );
        $method->setAccessible(true);

        $result = $method->invoke(new GoodRepository());

        $this->assertEquals('goods', $result);
    }

    public function testPrivateGetEntityName()
    {

        $method = new \ReflectionMethod(
                GoodRepository::class,
                'getEntityName'
        );
        $method->setAccessible(true);

        $result = $method->invoke(new GoodRepository());

        $this->assertEquals(Good::class, $result);
    }
}
