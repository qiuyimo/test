<?php

/**
 * 测试url
 */

require dirname(__FILE__)."/../vendor/autoload.php";

$url = '//images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
// $url = 'images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
// $url = 'https://images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
// $url = 'http://images10.newegg.com/ProductImageCompressAll300/11-146-238-03.jpg';
$url = 'https://images10.newegg.com:8080/ProductImageCompressAll300/11-146-238-03.jpg?a=abc&b=123#44';
// $url = '/ProductImageCompressAll300/11-146-238-03.jpg?a=abc&b=123#44';
dump(parse_url($url));
die;
$domain = 'https://images10.newegg.com';

dump(inspectUrl($url, $domain));

/**
 * 检查url
 * 如果是//开头, 则根据第三个个参数转变为标准的url格式, 默认是https
 * 如果是相对地址, 则根据第二个参数. 转换为完整的url.
 *
 * @author QiuYu
 * @param string $url 必须, url.
 * @param string $domain 必须, 域名. 如: https://www.ebay.com
 * @scheme string 如果url没有协议, 需要使用的url的协议.
 * @return string
 */
function inspectUrl($url, $domain, $scheme = 'https')
{
    if (!$url || !$domain) {
        return false;
    }
    if (($url[0] === '/') && ($url[1] !== '/')) {
        return rtrim($domain, '/') . $url;
    }

    $res = parse_url($url, PHP_URL_SCHEME);
    if (!$res) {
        return $scheme . '://' . ltrim($url, '//');
    } else {
        return $url;
    }
}
