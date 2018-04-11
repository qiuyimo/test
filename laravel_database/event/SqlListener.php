<?php

namespace app\model;

use Illuminate\Events\Dispatcher;
use Illuminate\Database\Events\QueryExecuted;

/**
 * sql监听类，记录sql日志。
 */
class SqlListener extends Dispatcher
{
    /**
     * 注意：就改这个函数。也可以记录到文件日志里。
     *
     * @param  string|object  $event
     * @param  mixed  $payload
     * @param  bool  $halt
     * @return array|null
     */
    public function dispatch($event, $payload = [], $halt = false)
    {
        if ($event instanceof  QueryExecuted) {
            $sql = $event->sql;
            if ($event->bindings) {
                foreach ($event->bindings as $v) {
                    $sql = preg_replace('/\\?/', "'". addslashes($v)."'", $sql, 1);
                }
            }
            dump($sql);
        }
    }
}
