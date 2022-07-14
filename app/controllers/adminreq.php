<?php

namespace Controller;
session_start();

class AdminReq {
    public function get(){
        \Controller\Utils::LoggedInAdmin();
        
        $uname=$_SESSION["uname"];
        echo \View\Loader::make()->render("templates/adminAR.twig",array(
            "adminreq" => \Model\Users::adminreq(),
            "uname" =>$uname,
        ));
    }
}