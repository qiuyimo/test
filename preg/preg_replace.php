<?php
/**
 * 测试正则表达式替换函数
 * User: qiuyu
 * Date: 2018-03-12 17:56:24
 */
require dirname(__FILE__)."/../vendor/autoload.php";

$link = 'https://i.ebayimg.com/images/g/iq0AAOSwJ4hY-yfg/s-l225.jpg';

$res = preg_replace('/(.*?s-l)([0-9]+)(\.jpg)$/', '${1}250$3', $link);
dump($res);

// 输出
// https://i.ebayimg.com/images/g/iq0AAOSwJ4hY-yfg/s-l250.jpg
