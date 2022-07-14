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
        $username = $_POST["username"];
        $password = $_POST["password"];
        $passwordconfirm = $_POST["passwordconfirm"];
        $result = \Model\Users::checkAdmin($username);
        if (!empty($result)) {
            $flag = false;
        } else {
            $flag = true;
        }
        $result = \Model\Users::checkAdminReq($username);
        if (!empty($result)) {
            $flag1 = false;
        } else {
            $flag1 = true;
        }
        if ($flag && $flag1) {
            if (strlen($password) < 8) {
                echo \View\Loader::make()->render("templates/registeradmin.twig", array("flag1" => true));
            } 
            else if ($password == $passwordconfirm) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                \Model\Users::createAdminReq($username, $hash);
                echo \View\Loader::make()->render("templates/authorize.twig", array("flag1" => true));
            } 
            else {
                echo \View\Loader::make()->render("templates/registeradmin.twig", array("flag" => true));
            }
        } 
        else {
            echo \View\Loader::make()->render("templates/registeradmin.twig", array("flag2" => true));
        }
    }
}
