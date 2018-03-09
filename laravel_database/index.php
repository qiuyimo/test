<?php
/**
 * 测试laravel的database
 * User: qiuyu
 * Date: 2018/3/9
 * Time: 上午11:09
 */

require dirname(__FILE__) . "/../vendor/autoload.php";
include(dirname(__FILE__) . "/Users.php");

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;

$database = [
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'new_spider',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

$db = new Manager;

// 创建链接
$db->addConnection($database);

// 设置全局静态可访问
$db->setAsGlobal();

// 启动Eloquent
$db->bootEloquent();

// 创建表
// Manager::schema()->create('users', function ($table) {
//     $table->increments('id');
//     $table->string('username', 40);
//     $table->string('email')->unique();
//     $table->timestamps();
// });

// 插入数据.
// Manager::table('users')->insert(array(
//     array('username' => 'Hello',  'email' => 'hello@world.com'),
//     array('username' => 'Carlos',  'email' => 'anzhengchao@gmail.com'),
//     array('username' => 'Overtrue',  'email' => 'i@overtrue.me'),
// ));


// $user = Users::find(1);
$users = Manager::table('users')->find(1);

dump($users->username);
