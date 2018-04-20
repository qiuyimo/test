<?php

namespace Test;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 *
 */
class TestCmd extends Command
{
    public function __construct($msg)
    {
        $this->msg = $msg;
        parent::__construct();
    }

    protected function configure()
    {
        // 设置命令名称
        $this->setName('test');

        // 设置描述
        $this->setDescription('This is a test');

        // 设置帮助说明
        $this->setHelp('Test, is a demo, only used by test code...');

        // configure an argument / 配置一个参数
        $this->addArgument('storeName', InputArgument::REQUIRED, 'The name of the store.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<comment>".$this->msg."</comment>");
        $output->writeln("<comment>".$input->getArgument('storeName')."</comment>");
    }
}
