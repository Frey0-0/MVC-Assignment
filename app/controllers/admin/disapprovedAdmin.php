<?php

namespace Controller;
session_start();

class DisapprovedAdmin{
    public function post(){
        \Controller\Utils::loggedInAdmin();
        
        $username=$_POST["username"];
        \Model\Users::disapprovedAdmin($username);
        header("Location:/admin/showadminreq");
    }
}