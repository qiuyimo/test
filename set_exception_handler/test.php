<?php

/**
 * 实验结果:
 *
 * register_shutdown_function, 存在多个, 会全部执行.
 * set_exception_handler, 存在多个, 只会执行最后一个.
 */

require dirname(__FILE__)."/../vendor/autoload.php";

class Example
{
    public function __construct()
    {
        set_exception_handler(array($this, 'exceptionHandler'));

        // throw new Exception('DOH!!');
    }

    public static function exceptionHandler($exception)
    {
        dump("Exception Caught: ". $exception->getMessage());
        dump(__METHOD__);
    }
}

register_shutdown_function('downFirst');
register_shutdown_function('downSecond');
register_shutdown_function('downThird');

set_exception_handler('exceptionHandlerFirst');
$example = new Example;
set_exception_handler('exceptionHandlerSecond');
set_exception_handler('exceptionHandlerThird');


// 实例化不存在的类, 会报致命错误.
new aaa;

echo "Not Executed\n";


function exceptionHandlerFirst($e)
{
    dump(__METHOD__);
}

function exceptionHandlerSecond($e)
{
    dump(__METHOD__);
}
function exceptionHandlerThird($e)
{
    dump(__METHOD__);
}

function downFirst()
{
    dump(__METHOD__);
}

function downSecond()
{
    dump(__METHOD__);
}
function downThird()
{
    dump(__METHOD__);
}