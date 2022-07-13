<?php

namespace Controller;

session_start();

class NewAdmin
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/registeradmin.twig");
    }

    public static function post()
    {
        $uname = $_POST["uname"];
        $pass = $_POST["pass"];
        $passc = $_POST["passc"];
        if (\Model\Users::checkadmin($uname) || \Model\Users::checkadminreq($uname)) {
            if ($pass == $passc) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                \Model\Users::createadminreq($uname, $hash);
                echo \View\Loader::make()->render("templates/authorize.twig");
            }
        }
    }
}
