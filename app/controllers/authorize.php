<?php

namespace Controller;
session_start();
class Authorize {
    public function get() {
        echo \View\Loader::make()->render("templates/authorize.twig");
    }
    public function post(){

        $uname=$_POST["uname"];
        $pass =$_POST["pass"];
        $result=\Model\Login::verifyAdmin($uname);
        if(empty($result)){
            echo \View\Loader::make()->render("templates/authorize.twig", array('flag' => true));
        }
        else if(password_verify($pass,$result["pass"])){
            $_SESSION["uname"] = $uname;
            $_SESSION["status"] = 1;
            $_SESSION["loggedin"] = 1;
            header("Location:/admin/dashboard");
        }
        else{
            echo \View\Loader::make()->render("templates/authorize.twig", array('flag' => true));
        }
    }
}