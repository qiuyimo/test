<?php
/**
 * 使用php解析xml
 * User: qiuyu
 * Date: 2018/3/13
 * Time: 上午10:54
 */

require dirname(__FILE__)."/../vendor/autoload.php";

$data = file_get_contents('./test.xml');

$serializer = JMS\Serializer\SerializerBuilder::create()->build();
$res = $serializer->serialize($data, 'array');
dump($res);
