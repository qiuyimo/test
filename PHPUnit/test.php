<?php
/**
 * PHPUnit usage
 * User: qiuyu
 * Date: 2018/2/15
 * Time: 上午11:33
 */

require dirname(__FILE__) . "/../vendor/autoload.php";

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }
}