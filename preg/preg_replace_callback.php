<?php
/**
 * 测试正则表达式替换回调函数
 * User: qiuyu
 * Date: 2018-03-12 17:56:24
 */
require dirname(__FILE__)."/../vendor/autoload.php";

$link = ' https://i.ebayimg.com/images/g/iq0AAOSwJ4hY-yfg/s-l225.jpg';

$res = preg_replace_callback('/(.*?s-l)([0-9]+)(\.jpg)$/', function ($matches) {
    dump($matches);
}, $link);

dump($res);
