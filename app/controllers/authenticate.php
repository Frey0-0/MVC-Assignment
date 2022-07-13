<?php

namespace Controller;
session_start();
class Authenticate {
    public function get() {
        echo \View\Loader::make()->render("templates/authenticate.twig");
    }

    public function post(){
        $uname=$_POST["uname"];
        $pass =$_POST["pass"];
        $result=\Model\Login::verifyClient($uname);
        if(empty($result)){
            echo \View\Loader::make()->render("templates/notclient.twig");
        }
        else if(password_verify($pass,$result["pass"])){
            $_SESSION["uname"] = $uname;
            $_SESSION["status"] = 0;
            $_SESSION["loggedin"] = 1;
            header("Location:/client/dashboard");
        }
        else{
            echo \View\Loader::make()->render("templates/notclient.twig");
        }
    }
}