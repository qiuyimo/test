<?php
/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/4/16
 * Time: 下午12:08
 */

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/Email.php';
include __DIR__ . '/UserManager.php';

use Illuminate\Container\Container;
use User\UserManager;

$container = Container::getInstance();

$userManager = $container->make(UserManager::class);
$res = $userManager->register('530004000@qq.com', 'password');
dump($res);
