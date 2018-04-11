<?php

require dirname(__FILE__) . "/../../vendor/autoload.php";

include './SqlListener.php';
include './Goods.php';

use Illuminate\Database\Capsule\Manager;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use app\model\SqlListener;
use app\model\Goods;

$capsule = new Manager();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '192.168.10.2',
    'database' => 'test',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => ''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();


// 设置sql日志监听
$capsule->setEventDispatcher(new SqlListener());

// User模型类加钩子
Goods::setEventDispatcher(new Dispatcher());
Goods::observe(\app\model\GoodsObserver::class);

// 这句话单纯测试log
$users = $capsule::select('SELECT * FROM goods LIMIT 1');

// 下面几句测log + 钩子
$goods = new Goods();
$goods->title = '11';
$result = $goods->save(); // 新模型添加
$goods->title = '22';
$result = $goods->save(); // 已经不是新模型，是已存在模型，所以是修改。

$goods = new Goods();
$goods->title = '3'; // 故意填写过短的用户名
$result = $goods->save(); // 注意这里！因为创建模型前置函数creating返回假。
if (!$result) {
    dump($goods->getErrorInfo());
}

dump('complete');
