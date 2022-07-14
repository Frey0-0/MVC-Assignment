<?php

namespace Controller;
session_start();

class AdminReq {
    public function get(){
        \Controller\Utils::LoggedInAdmin();
        
        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/adminAR.twig",array(
            "adminreq" => \Model\Users::AdminReq(),
            "username" =>$username,
        ));
    }
}