<?php

class Good
{
	public $id = '';
	public $prod = '';
	public $name = '';
	public $price = '';
	public $type = '';

	public function __construct($id, $prod, $name, $price, $type)
	{
		$this->id = $id;
		$this->prod = $prod;
		$this->name = $name;
		$this->price = $price;
		$this->type = $type;
	}

	public function counter()
	{
		var_dump(static::$count++);
	}

	public function display()
    {
		return $this->getName() . $this->getPrice() . $this->getType() . $this->getProd();
	}

	public function getProd()
    {
		return "
				<h3>Производство: {$this->prod}</h3>
			";
	}

	public function getName()
	{
		return "
				<h2>{$this->name}</h2>
			";
	}

	public function getPrice()
	{
		return "
				<h1>цена: {$this->price}р.</h1>
			";
	}

	public function getType()
	{
		return "
				<h3>категория: {$this->type}</h3>
			";
	}
};

class OtherGood extends Good
{
	public $deliverer = '';
	public $contractDate = '';
	public $contactPerson = '';
	public $phone = '';

	public function __construct(
			$id,
			$prod,
			$name,
			$price,
			$type,
			$deliverer,
			$contractDate,
			$contactPerson,
			$phone
		)
	{
		$this->deliverer = $deliverer;
		$this->contractDate = $contractDate;
		$this->contactPerson = $contactPerson;
		$this->phone = $phone;
		parent::__construct($id, $prod = 'внешний поставщик', $name, $price, $type);
	}

	public function display()
    {
		return parent::display() . $this->getDeliverer() . $this->getDelivererInfo();
	}

	public function getDeliverer()
	{
		return "
				<h3>Наименование поставщика: {$this->deliverer}</h3>
			";
	}

	public function getDelivererInfo()
	{
		return "
				<p>дата заключения контракта: {$this->contractDate}</p>
				<p>контактное лицо: {$this->contactPerson}</p>
				<p>телефон: {$this->phone}</p>
			";
	}
}

$good = new Good(
		1,
		'пекарня магазина',
		'лаваш',
		'45',
		'выпечка'
	);
echo $good->display() . '<hr>';

$good2 = new Good(
		2,
		'собственный цех',
		'пирожок с мясом',
		'98',
		'выпечка'
	);
echo $good2->display() . '<hr>';

$good3 = new OtherGood(
		3,
		'',
		'торт "Прага"',
		'215',
		'кондитерские изделия',
		'"Красный октябрь"',
		'25.08.2016',
		'Иванов Сергей Александрович',
		'8-909-123-45-67'
	);
echo $good3->display() . '<hr>';

$good4 = new OtherGood(
		4,
		'',
		'торт "Опера"',
		'199',
		'кондитерские изделия',
		'"Восток"',
		'01.03.2009',
		'Петров Алексей Борисович',
		'8-906-047-12-34'
	);
echo $good4->display() . '<hr>';

$good5 = new OtherGood(
		5,
		'',
		'морс из клюквы',
		'62',
		'напитки',
		'"Русский Морс"',
		'09.07.2018',
		'Гаврилова Дарья Ивановна',
		'8-915-047-32-12'
	);
echo $good5->display() . '<hr>';

?>
<h2 style="color: brown">Задание №5</h2>
<?php

class A
{
	public function foo()
	{
		static $x = 0;
		echo ++$x;
	}
}

$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();      //$x является статичным свойством, поэтому его значение во всех экземплярах будет единым, оно увеличивается на 1 при 					 //каждом вызове
?>
<h4 style="color: blue">$x является статичным свойством, поэтому его значение во всех экземплярах будет единым, оно увеличивается на 1 при каждом вызове</h4>
<h2 style="color: brown">Задание №6</h2>
<?php

class C
{
	public function foo()
	{
		static $x = 0;
		echo ++$x;
	}
}
class B extends C
{

}

$a1 = new C();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();      //B - это новый класс, который имеет своё собственное статичное свойство $x

?>
<h4 style="color: blue">B - это новый класс, который имеет своё собственное статичное свойство $x</h4>
<h2 style="color: brown">Задание №7</h2>
<?php

class D
{
	public function foo()
	{
		static $x = 0;
		echo ++$x;
	}
}
class E extends D
{

}

$a1 = new D;
$b1 = new E;

$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

?>
<h4 style="color: blue">Тут я не понял вроде то же самое, что и в 6ом задании только экземпляры класса созданы без написания скобок. Получается это ни на что не влияет?</h4>