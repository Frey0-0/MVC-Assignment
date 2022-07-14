<?php

namespace Controller;
session_start();
class Authorize {
    public function get() {
        echo \View\Loader::make()->render("templates/authorize.twig");
    }
    public function post(){

        $username=$_POST["username"];
        $password =$_POST["password"];
        $result=\Model\LogIn::verifyAdmin($username);
        
        if(empty($result)){
            echo \View\Loader::make()->render("templates/authorize.twig", array('flag' => true));
        }
        else if(password_verify($password,$result["password"])){
            $_SESSION["username"] = $username;
            $_SESSION["status"] = 1;
            $_SESSION["loggedin"] = 1;

            header("Location:/admin/dashboard");
        }
        else{
            echo \View\Loader::make()->render("templates/authorize.twig", array('flag' => true));
        }
    }
}