<?php

/**
 * 测试 symfony/console 组件.
 * @date 2018-04-19
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

// 创建控制台.
$console = new Application('SpiderPure', '1.0.0');

// 注册一个命令.
$command = $console->register('spider');

// 命令的参数.
$command->addArgument('name', InputArgument::OPTIONAL, 'Name of the person');

// 命令的选项
$command->addOption('say', 's', InputOption::VALUE_REQUIRED, 'Custom greeting');

// 执行命令
$command->setCode(function (InputInterface $input, OutputInterface $output) {
    // 获取参数
    $name = $input->getArgument('name');
    // 获取选项
    $greeting = $input->getOption('say');

    // 输出
    $output->writeln("<info>Argument: $name</info>");
    $output->writeln("<info>Option: $greeting</info>");

    if (!empty($name) && !empty($greeting)) {
        return $output->writeln("<info>$greeting $name!</info>");
    } elseif (!empty($name)) {
        return $output->writeln("<info>Hello $name!</info>");
    } elseif (!empty($greeting)) {
        return $output->writeln("<info>$greeting World!</info>");
    } else {
        return $output->writeln("<info>Hello World!</info>");
    }
});

$app = $command->getApplication();

try {
    $app->run();
} catch (Exception $e) {
    dump('error');
    dump($e);
}


/**
 * 输出
➜  console git:(master) ✗ php console_demo.php spider qiuyu -s haha
Argument: qiuyu
Option: haha
haha qiuyu!
➜  console git:(master) ✗
 *
 */
