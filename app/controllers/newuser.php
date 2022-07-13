<?php

namespace Controller;

session_start();

class NewUser
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/register.twig");
    }

    public static function post()
    {
        $uname = $_POST["uname"];
        $pass = $_POST["pass"];
        $passc = $_POST["passc"];
        echo $uname;
        echo $pass;
        echo $passc;
        $s= \Model\Users::checkuser($uname);
        echo isset($s);
        if (\Model\Users::checkuser($uname)) {
            if ($pass == $passc) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                \Model\Users::createuser($uname, $hash);
                $_SESSION["uname"] = $uname;
                $_SESSION["status"] = 0;
                $_SESSION["loggedin"] = 1;
                header("Location:/client/dashboard");
            }
        }
    }
}
