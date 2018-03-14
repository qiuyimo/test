<?php
/**
 * 使用guzzle
 * User: qiuyu
 * Date: 2018/3/13
 * Time: 下午4:20
 */

require dirname(__FILE__)."/../vendor/autoload.php";

use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;

$database = [
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'new_spider',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];

$db = new Manager;
$db->addConnection($database);
$db->setAsGlobal();
$db->bootEloquent();

$client = new \GuzzleHttp\Client();

do {
    $loop = true;
    $urlRes = Manager::table('top100')->where('status', 0)->first(['url', 'id']);
    if ($urlRes) {
        $url = $urlRes->url;
        dump($url);

        $res = $client->request('GET', $url);
        dump('code: ' . $res->getStatusCode());
        $html = (string)$res->getBody();

        $crawler = new Crawler($html);
        $topList = $crawler->filter('div#zg_left_col2 li a');

        $i = 0;
        foreach ($topList as $k => $a) {
            // dump($a->textContent . ' : '. $a->getAttribute('href'));
            $info = [];
            $info['url'] = rtrim(substr($a->getAttribute('href'), 0, strpos($a->getAttribute('href'), 'ref=')), '/');
            $info['top_url'] = $url;

            $selectRes = Manager::table('top100')->where('url', $info['url'])->first();
            if (!$selectRes) {
                // 插入数据.
                $insertRes = Manager::table('top100')->insert($info);
                if (!$insertRes) {
                    dump('插入数据失败', $info);
                } else {
                    $i++;
                }
            } else {
                dump('重复数据不入库, id: ' . $selectRes->id);
            }
        }

        dump('插入 ' . $i . ' 条数据');

        // 更新数据的状态. 改为已经抓全.
        $updateRes = Manager::table('top100')->where('id', $urlRes->id)->update(['status' => 1]);
        if (!$updateRes) {
            dump('更改状态失败, ID: ' . $urlRes->id);
        }

        echo "\n";
    } else {
        $loop = false;
    }
} while ($loop);



function dd($data)
{
    dump($data);
    die;
}
