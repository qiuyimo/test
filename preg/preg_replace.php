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


$link = 'https://i5.walmartimages.com/asr/8470bc79-4ebf-49f5-b7ad-7f04fa42af54_1.7eeb449c0adb050de0d4b7990bb0ab79.jpeg?odnWidth=180&odnHeight=180&odnBg=ffffff';
$res = preg_replace('/(.*?s-l)([0-9]+)(\.jpg)$/', '${1}250$3', $link);
dump($res);
// 输出
// https://i.ebayimg.com/images/g/iq0AAOSwJ4hY-yfg/s-l250.jpg