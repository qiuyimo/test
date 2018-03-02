<?php
/**
 * 发送邮件测试, 可以发送图片. 附件.
 * User: qiuyu
 * Date: 2018/3/1
 * Time: 下午4:41
 */

require dirname(__FILE__)."/../vendor/autoload.php";

define('_LOG_', dirname(__FILE__) . '/log');

sendEmail();

/**
 * 发送邮件
 */
function sendEmail()
{
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.163.com', 25))
        ->setUsername('promopure@163.com')
        ->setPassword('qiuyu123') // 这个密码是授权密码, 在网易邮箱设置中的授权密码, 而不是邮箱的登录密码.
    ;

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message())
        ->setFrom(['promopure@163.com' => 'promopure'])
        ->setTo(['530004000@qq.com'])
    ;

    // 设置邮件主题
    $message->setSubject('警告, 遇到反爬虫')

        // 设置邮件内容,可以省略content-type
        ->setBody(
            '<html>' .
            ' <head></head>' .
            ' <body>' .
            ' Here is an image <img src="' . // 内嵌文件
            $message->embed(Swift_Image::fromPath(_LOG_ . '/test.png')) .
            '" alt="Image" />' .
            ' Rest of message' .
            ' </body>' .
            '</html>',
            'text/html'
        );

    // 创建attachment对象，content-type这个参数可以省略
    $attachment = Swift_Attachment::fromPath(_LOG_ . '/test.png', 'image/png')
        ->setFilename('test.png');

    // 添加附件
    $message->attach($attachment);

    // Send the message
    $result = $mailer->send($message);
}
