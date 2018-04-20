#!/usr/bin/env php

<?php

require __DIR__ . '/../../vendor/autoload.php';
require './MyCmd.php';

use Test\TestCmd;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new TestCmd("hello console"));
$application->run();
