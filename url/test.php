<?php

/**
 * 测试url
 */

require dirname(__FILE__)."/../vendor/autoload.php";

$url = '//images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
$url = 'images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
$url = 'https://images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
$url = 'http://images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
$url = 'https://images10.newegg.com:8080/ProductImageCompressAll300/11-146-238-03.jpg?a=abc&b=123#44';
dump(inspectUrl($url));

/**
 * 检查url, 如果是//开头, 则返回https://开头的url
 *
 * @param string $url
 * @scheme string 如果url没有协议, 需要使用的url的协议
 * @return string
 */
function inspectUrl($url, $scheme = 'https')
{
    $res = parse_url($url, PHP_URL_SCHEME);
    if (!$res) {
        return $scheme . '://' . ltrim($url, '//');
    } else {
        return $url;
    }
}
