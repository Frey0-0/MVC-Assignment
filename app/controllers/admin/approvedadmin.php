<?php

namespace Controller;
session_start();

class ApprovedAdmin{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $username=$_POST["username"];
        $result = \Model\Users::ApprovedAdmin($username);
        \Model\Users::ApprovedAdminInsert($username,$result[0]["password"]);
        \Model\Users::ApprovedAdminDelete($username);
        header("Location:/admin/showadminreq");
    }
}