<?php
/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/1/16
 * Time: 下午11:36
 */
require_once(dirname(__FILE__)."/vendor/autoload.php");

$browser = new Buzz\Browser();
$headers = [
    'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36',
    'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
    'Accept-Encoding:gzip, deflate, br',
    'Accept-Language:zh-CN,zh;q=0.9',
    'Cache-Control:max-age=0',
    'Connection:keep-alive',
    'Referer:https://packagist.org/?q=curl&p=0',
    'Upgrade-Insecure-Requests:1'
];
$response = $browser->get('http://httpbin.org/headers', $headers);

dump($browser->getLastRequest());
// $response is an object.
// You can use $response->getContent() or $response->getHeaders() to get only one part of the response.
dump($response->getHeaders());
dump($response->getContent());


