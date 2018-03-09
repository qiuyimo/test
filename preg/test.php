<?php
/**
 * 测试正则表达式
 * User: qiuyu
 * Date: 2018/3/9
 * Time: 上午10:35
 */
require dirname(__FILE__)."/../vendor/autoload.php";

$link = 'https://www.walmart.com/ip/Element-40-1080p-60Hz-LED-TV/898659538';

preg_match('/([0-9]+)$/', $link, $match);
dump($match);
