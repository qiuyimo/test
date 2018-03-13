<?php
/**
 * 删除指定字符后面的字符串
 * User: qiuyu
 * Date: 2018/3/12
 * Time: 下午6:24
 */

require dirname(__FILE__)."/../vendor/autoload.php";

$imageUrl = 'https://i5.walmartimages.com/asr/8470bc79-4ebf-49f5-b7ad-7f04fa42af54_1.7eeb449c0adb050de0d4b7990bb0ab79.jpeg?odnWidth=180&odnHeight=180&odnBg=ffffff';
// $imageUrl = 'https://i5.walmartimages.com/asr/8470bc79-4ebf-49f5-b7ad-7f04fa42af54_1.7eeb449c0adb050de0d4b7990bb0ab79.jpeg';
// $res = substr($imageUrl, 0, strpos($imageUrl, '?'));
// $res = substr($imageUrl, 0, (strpos($imageUrl, '?') === false) ? strlen($imageUrl) : strpos($imageUrl, '?'));
$res = substr($imageUrl, 0, (strpos($imageUrl, '?')) ?: strlen($imageUrl));
dump($res);
