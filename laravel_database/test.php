<?php
/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/4/11
 * Time: 上午11:46
 */

require dirname(__FILE__) . "/../vendor/autoload.php";

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;

$database = [
    'driver'    => 'pgsql',
    'host'      => '192.168.10.2',
    'database'  => 'shops',
    'username'  => 'postgres',
    'password'  => 'postgres',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    // 'options'  => [
    //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // ]
];

$db = new Manager;
// 创建链接
$db->addConnection($database);
// 设置全局静态可访问
$db->setAsGlobal();
// 启动Eloquent
$db->bootEloquent();


// $res = $db::select("select * from article where category = 'A44X1AWPEE' limit 1");
//
// dump($res);

$res = $db::table('article')->where('id', 222)->get();

dump($res);

$res = $db::table('article')->where('id', 222)->get()->toArray();

dump($res);