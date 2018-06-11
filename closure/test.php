<?php
/**
 * 匿名函数测试
 * User: qiuyu
 * Date: 2018/4/23
 * Time: 上午10:56
 */

include __DIR__ . '/../vendor/autoload.php';

$foo = 'foo';
$demo = 'demo';

$test = function ($name) use ($foo, $demo) {
    return 'name: ' . $name . ', foo: ' . $foo . ', demo: ' . $demo;
};

dump($test('QiuYu'));

function testClosure(Closure $closure, string $mac): string
{

    dump($closure($mac));
}

testClosure($test, 'mac');
