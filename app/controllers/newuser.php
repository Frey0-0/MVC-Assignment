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
        if (\Model\Users::checkuser($uname)) {
            if(strlen($pass)<8){
                echo \View\Loader::make()->render("templates/register.twig", array( "flag1" =>true));
            }
            else if ($pass == $passc) {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                \Model\Users::createuser($uname, $hash);
                $_SESSION["uname"] = $uname;
                $_SESSION["status"] = 0;
                $_SESSION["loggedin"] = 1;
                header("Location:/client/dashboard");
            }
            else{
                echo \View\Loader::make()->render("templates/register.twig", array( "flag" =>true));
            }
        }
        else{
            echo \View\Loader::make()->render("templates/register.twig", array( "flag2" =>true));
        }
    }
}
