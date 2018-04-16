<?php
/**
 * Created by PhpStorm.
 * User: qiuyu
 * Date: 2018/4/16
 * Time: 下午12:03
 */

namespace User;

use Mail\Email;

class UserManager
{
    private $mailer;

    public function __construct(Email $mailer)
    {
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        // register action
        echo "register complete.\n";

        // send mail
        return $this->mailer->mail($email, 'welcome');
    }
}
