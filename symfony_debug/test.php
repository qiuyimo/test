<?php
/**
 * 经过测试, 这个只适用于网页版本. cli 也会输出 html. 所以 cli 用不了.
 * User: qiuyu
 * Date: 2018/4/20
 * Time: 上午11:15
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\DebugClassLoader;

Debug::enable();
ErrorHandler::register();
ExceptionHandler::register();
DebugClassLoader::enable();

// 实例化一个不存在的类. 应该报错. 测试结果.
new aaa();
