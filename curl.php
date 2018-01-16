<?php
/**
 * 测试curl, 打印请求头
 * User: qiuyu
 * Date: 2018/1/16
 * Time: 下午11:24
 */
require_once(dirname(__FILE__)."/vendor/autoload.php");

$res = get('http://www.baidu.com');
dump($res);
exit;


function get($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。

    $header = ['User-Agent: php test']; //设置一个你的浏览器agent的header
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    curl_setopt($ch, CURLOPT_HEADER, 1); //返回response头部信息
    curl_setopt($ch, CURLINFO_HEADER_OUT, true); //TRUE 时追踪句柄的请求字符串，从 PHP 5.1.3 开始可用。这个很关键，就是允许你查看请求header

    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);

    echo curl_getinfo($ch, CURLINFO_HEADER_OUT); //官方文档描述是“发送请求的字符串”，其实就是请求的header。这个就是直接查看请求header，因为上面允许查看

    curl_close($ch);

    return $result;
}