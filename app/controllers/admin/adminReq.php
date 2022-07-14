<?php

namespace Controller;
session_start();

class AdminReq {
    public function get(){
        \Controller\Utils::loggedInAdmin();
        
        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/adminAdminRequests.twig",array(
            "adminreq" => \Model\Users::adminReq(),
            "username" =>$username,
        ));
    }
}