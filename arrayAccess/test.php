<?php

namespace InterfaceTest;

use ArrayAccess;

class TestArrayAccess implements ArrayAccess
{
    # 存储数据
    private $data = [];

    /**
     * 以对象的方式访问数组中的数据
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data[$key];
    }

    /**
     * 以对象方式添加一个数组元素
     *
     * @param $key
     * @param $val
     */
    public function __set($key, $val)
    {
        $this->data[$key] = $val;
    }

    /**
     * 以对象方式判断数组元素是否设置
     *
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * 以对象方式删除一个数组元素
     *
     * @param $key
     */
    public function __unset($key)
    {
        unset($this->data[$key]);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }

    /**
     * @return array
     */
    public function &__invoke()
    {
        return $this->data;
    }
}

$testArrayAccess = new \InterfaceTest\TestArrayAccess();

$testArrayAccess['one'] = '小明';
$testArrayAccess->two = '小红';
$testArrayAccess['three'] = '邪皇';
$testArrayAccess->four = '魔伶'; # 调用ArrayAndObjectAccess::__set
$testArrayAccess['five'] = '天尊'; # 调用ArrayAndObjectAccess::offsetSet

var_dump(isset($testArrayAccess->one)); # 调用ArrayAndObjectAccess::__isset
unset($testArrayAccess->two); # 调用ArrayAndObjectAccess::__unset

var_dump($testArrayAccess->one); # 调用ArrayAndObjectAccess::__get
var_dump($testArrayAccess->three);
var_dump($testArrayAccess->four);
var_dump($testArrayAccess->five);

var_dump(isset($testArrayAccess['one'])); # 调用ArrayAndObjectAccess::offsetExists
unset($testArrayAccess['two']); # 调用ArrayAndObjectAccess::offsetUnset

var_dump($testArrayAccess['one']); # 调用ArrayAndObjectAccess::offsetGet
var_dump($testArrayAccess['three']);
var_dump($testArrayAccess['four']);
var_dump($testArrayAccess['five']);

var_dump($testArrayAccess);
var_dump($testArrayAccess());
var_dump(array_values($testArrayAccess()));
$var = 'hi';
$testArrayAccess['a'] = $var;
$testArrayAccess()['b'] = &$var;
$var = 'baby';
array_push($testArrayAccess(), 'test'); # int array_push ( array &$array , mixed $value1 [, mixed $... ] )
var_dump($testArrayAccess);
var_dump(reset($testArrayAccess())); # mixed reset ( array &$array )
var_dump(array_key_exists('five', $testArrayAccess()));
