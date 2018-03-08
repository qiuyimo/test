<?php
/**
 * monolog package usage
 * User: qiuyu
 * Date: 2018/2/14
 * Time: 下午1:44
 */

require dirname(__FILE__)."/../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Formatter\JsonFormatter;

// 实例化一个日志实例, 参数是 channel name
$logger = new Logger('qiuyuhome');

// StreamHandler_1
$streamHander1 = new StreamHandler(__DIR__.'/testLog1.log', Logger::INFO);
// 设置日志格式为json
$streamHander1->setFormatter(new JsonFormatter());
// 入栈, 往 handler stack 里压入 StreamHandler 的实例
$logger->pushHandler($streamHander1);

// StreamHandler_2
// 如果第三个参数为false, 则只会执行这个一个Handler. 默认是true
$streamHander2 = new StreamHandler(__DIR__.'/testLog2.log', Logger::INFO);
// 入栈, 往 handler stack 里压入 StreamHandler 的实例
$logger->pushHandler($streamHander2);

// 日志处理器.
$mailer = new Swift_Mailer((new Swift_SmtpTransport('smtp.163.com', 25))->setUsername('promopure@163.com')->setPassword('qiuyu123'));
$message = (new Swift_Message())->setFrom(['promopure@163.com' => 'promopure'])->setTo(['530004000@qq.com']);
$message->setSubject('警告, 快点来看看这个情况.')->setBody('快点来看看这个情况, 需要快点处理一下.');
$emailHander = new SwiftMailerHandler($mailer, $message);
$logger->pushHandler($emailHander);

/**
 * processor 日志加工程序，用来给日志添加额外信息.
 *
 * 这里调用了内置的 UidProcessor 类和 ProcessIdProcessor 类.
 * 在生成的日志文件中, 会在最后面显示这些额外信息.
 */
$logger->pushProcessor(new UidProcessor());
$logger->pushProcessor(new ProcessIdProcessor());
$logger->pushProcessor(function ($record) {
    dump('[' . date("Y-m-d H:i:s", time()) . '] ' . $record['message']);
    if ($record['context']) {
        dump($record['context']);
    }
    return $record;
});

/**
 * 设置记录到日志的信息.
 *
 * 开始遍历 handler stack.
 * 先入后出, 后压入的最先执行. 所以先执行 FirePHPHandler, 再执行 StreamHandler
 * 因为设置了 ErrorLogHandler 的 $bubble = false, 所以会停止冒泡, StreamHandler 不会执行.
 * 第二个参数为数组格式, 通过使用使用上下文(context)添加了额外的数据.
 * 简单的处理器（比如StreamHandler）将只是把数组转换成字符串。而复杂的处理器则可以利用上下文的优点（如 FirePHP 则将以一种优美的方式显示数组）.
 */
$info = [
    "keywords" => "",
    "title" => "Cuffed Beanies for $30",
    "description" => "Available whilst stocks last.",
    "third_part_id" => "14185192",
    "source_detail_url" => "https://www.anycodes.com/coupon-detail-14185192.html",
    "list_url" => "https://www.anycodes.com/promo-codes/loveyourmelon.com",
    "store_id" => 5065,
    "type" => "",
    "source" => "anycodes",
    "verify" => 0,
    "create_time" => 1519954797,
    "modify_time" => "2018-03-02 09:39:57",
    "link" => "https://www.loveyourmelon.com/collections/cuffedhats",
];
$logger->info('商城信息', $info);

$logger->info('操作记录, 遇到反爬虫');

$logger->error('打开网页错误');
