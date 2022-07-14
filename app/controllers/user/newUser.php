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
        $username = $_POST["username"];
        $password = $_POST["password"];
        $passwordconfirm = $_POST["passwordconfirm"];

        $result = \Model\Users::checkUser($username);
        if (!empty($result)) {
            $flag = false;
        } 
        else {
            $flag = true;
        }

        if ($flag) {
            if (strlen($password) < 8) {
                echo \View\Loader::make()->render("templates/register.twig", array("flag1" => true));
            } 
            else if ($password == $passwordconfirm) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                \Model\Users::createUser($username, $hash);
                $_SESSION["username"] = $username;
                $_SESSION["status"] = 0;
                $_SESSION["loggedin"] = 1;
                
                header("Location:/client/dashboard");
            } 
            else {
                echo \View\Loader::make()->render("templates/register.twig", array("flag" => true));
            }
        } 
        else {
            echo \View\Loader::make()->render("templates/register.twig", array("flag2" => true));
        }
    }
}
