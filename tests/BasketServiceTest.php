<?php

namespace app\tests;

use app\repositories\GoodRepository;
use app\services\BasketService;
use app\services\Request;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BasketServiceTest extends TestCase
{
    public function testAddEmptyGood()
    {
        /** @var GoodRepository|MockObject $goodRepository */
        $goodRepository = $this->getMockBuilder(GoodRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $goodRepository->method('getOne')
            ->willReturn(false);
        $goodRepository
            ->expects(self::once())
            ->method('getOne');

        $mockRequest = $this->createMock(Request::class);

        $basketServices = new BasketService();
        $result = $basketServices->add(12, $goodRepository, $mockRequest);
        $this->assertEquals('нет товара', $result);
    }

    public function testAddEmptyId()
    {
        $mockRequest = $this->createMock(Request::class);   //<-- создание заглушки

        $basketServices = new BasketService();
        $result = $basketServices->add(0, (new GoodRepository()), $mockRequest);

        $this->assertEquals('нет id', $result);
    }

    /**
     * @param $priceReal
     * @param $tax
     * @param $expected
     *
     * @dataProvider getDataForTestGetPrice
     */
    public function testGetPrice($priceReal, $tax, $expected)
    {
        $basketServices = new BasketService();
        $price = $basketServices->getPrice($priceReal, $tax);

        $this->assertEquals($expected, $price);
    }

//-------------------- тестирование приватного класса --------------------//

    /**
     * @param $priceReal
     * @param $tax
     * @param $expected
     *
     * @dataProvider getDataForTestGetPrice
     */
    public function testGetPrivatePrice($priceReal, $tax, $expected)   //<-- тестирование приватного класса
    {
        $method = new \ReflectionMethod(
            BasketService::class,   //<-- получаем полное имя класса с путём до него
            'getPrivatePrice'
        );
        $method->setAccessible(true);

        $price = $method->invoke(new BasketService(), $priceReal, $tax);

        $this->assertEquals($expected, $price);
    }

    public function getDataForTestGetPrice()
    {
        return [
            [100, 0.5, 150],
            [100, 0.7, 170]
        ];
    }
}