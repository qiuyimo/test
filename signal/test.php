<?php

/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/4/27
 * Time: 上午9:34
 */

declare(ticks = 1);

require __DIR__ . '/../vendor/autoload.php';

if (function_exists('pcntl_signal')) {
    // 终止信号
    pcntl_signal(SIGTERM, function () {
        dump('进程收到 SIGTERM 信号, 被 kill 终止');
        die;
    });
    // 终端挂起或者控制进程终止
    pcntl_signal(SIGHUP, function () {
        dump('进程收到 SIGHUP 信号, 被终止.');
        die;
    });
    // 键盘中断（如break键被按下）
    pcntl_signal(SIGINT, function () {
        dump('进程收到 SIGINT 信号, 被 Ctrl + C 终止.');
        die;
    });
} else {
    dump('不能使用信号控制');
}

for ($i = 0; $i < 500000; $i++) {
    echo $i . ' ';
    sleep(1);
}
