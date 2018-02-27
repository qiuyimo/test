<?php
/**
 * curl使用代理测试
 * User: qiuyu
 * Date: 2018/2/27
 * Time: 下午10:10
 */

require dirname(__FILE__)."/../vendor/autoload.php";

// http://www.daxiangdaili.com/orders
$proxy = "118.114.77.47";
$proxyport = "8080";
$ch = curl_init("http://httpbin.org/ip");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYPORT, $proxyport);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$result = curl_exec($ch);
file_put_contents('./html.html', $result);
dump($result);

curl_close($ch);
