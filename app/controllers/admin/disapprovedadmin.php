<?php

namespace Controller;
session_start();

class DisapprovedAdmin{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $username=$_POST["username"];
        \Model\Users::DisapprovedAdmin($username);
        header("Location:/admin/showadminreq");
    }
}