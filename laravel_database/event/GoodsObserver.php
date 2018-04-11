<?php

namespace app\model;

use app\model\Goods;

/**
 * Goods类的观察者。放置了各种钩子函数
 *
 */
class GoodsObserver
{

    /**
     * 添加钩子
     *
     * 特别点在于，前置类型的钩子，如返回假则后面不执行。
     * 后缀是ing的钩子函数，就是前置类型的钩子。如updating，deleting等。共5个。
     *
     * @param  Goods $goods
     */
    public function creating(Goods $goods)
    {
        if (strlen($goods->title) < 2) {
            $goods->setErrorInfo("creating: 标题至少两个字符");
            return false;
        }
    }

    /**
     * 添加钩子
     *
     * @param  Goods $goods
     * @return void
     */
    public function created(Goods $goods)
    {
        dump("In GoodsObserver.created: " . $goods->id);
    }

    /**
     * 修改钩子
     *
     * @param  Goods $goods
     * @return void
     */
    public function updated(Goods $goods)
    {
        dump("In UserObserver.updated: " . $goods->id);
    }
}
