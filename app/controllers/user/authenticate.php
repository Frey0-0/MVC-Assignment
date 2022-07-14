<?php

namespace Controller;
session_start();
class Authenticate {
    public function get() {
        echo \View\Loader::make()->render("templates/authenticate.twig");
    }

    public function post(){

        $username=$_POST["username"];
        $password =$_POST["password"];
        $result=\Model\LogIn::verifyClient($username);
        if(empty($result)){
            echo \View\Loader::make()->render("templates/authenticate.twig", array('flag' => true));
        }
        else if(password_verify($password,$result["password"])){
            $_SESSION["username"] = $username;
            $_SESSION["status"] = 0;
            $_SESSION["loggedin"] = 1;
            header("Location:/client/dashboard");
        }
        else{
            echo \View\Loader::make()->render("templates/authenticate.twig", array('flag' => true));
        }
    }
}