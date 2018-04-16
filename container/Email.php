<?php
/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/4/16
 * Time: 下午12:00
 */

namespace Mail;

class Email
{
    public function mail($sentTo, $content)
    {
        // sent mail to body.
        echo "sent mail complete.\n";

        return true;
    }
}
