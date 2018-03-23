<?php
/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/3/16
 * Time: 下午9:08
 */

require dirname(__FILE__)."/../vendor/autoload.php";

// 代码【2】
class Bim
{
    public $param = '123';

    public function __construct()
    {
        dump("Bim");
    }

    public function doSomething()
    {
        echo __METHOD__, '|';
    }
}

class Bar
{
    private $bim;

    public function __construct(Bim $bim)
    {
        dump($bim);
        $this->bim = $bim;
    }

    public function doSomething()
    {
        $this->bim->doSomething();
        echo __METHOD__, '|';
    }
}

class Foo
{
    private $bar;

    public function __construct(Bar $bar)
    {
        dump($bar);
        $this->bar = $bar;
    }

    public function doSomething()
    {
        $this->bar->doSomething();
        echo __METHOD__;
    }
}

echo "\n";

$foo = new Foo(
    new Bar(
        new Bim()
    )
);
$foo->doSomething();
// Bim::doSomething|Bar::doSomething|Foo::doSomething
