<?php

namespace app\tests;

use app\repositories\UserRepository;
use app\entities\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testPrivateGetTableName()
    {

        $method = new \ReflectionMethod(
                UserRepository::class,
                'getTableName'
        );
        $method->setAccessible(true);

        $result = $method->invoke(new UserRepository());

        $this->assertEquals('users', $result);
    }

    public function testPrivateGetEntityName()
    {

        $method = new \ReflectionMethod(
                UserRepository::class,
                'getEntityName'
        );
        $method->setAccessible(true);

        $result = $method->invoke(new UserRepository());

        $this->assertEquals(User::class, $result);
    }
}
