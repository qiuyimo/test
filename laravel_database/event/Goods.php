<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

/**
 * User模型类
 */
class Goods extends Model
{
    protected $table = 'goods';
    public $timestamps = false;

    // 这是我自己添加的，记录错误信息
    private $errorInfo = '';

    public function setErrorInfo($info)
    {
        $this->errorInfo = $info;
    }

    public function getErrorInfo()
    {
        return $this->errorInfo ;
    }
}
