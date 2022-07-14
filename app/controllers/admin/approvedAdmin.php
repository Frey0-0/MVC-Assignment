<?php

namespace Controller;
session_start();

class ApprovedAdmin{
    public function post(){
        \Controller\Utils::loggedInAdmin();
        
        $username=$_POST["username"];
        $result = \Model\Users::approvedAdmin($username);
        \Model\Users::approvedAdminInsert($username,$result[0]["password"]);
        \Model\Users::approvedAdminDelete($username);
        header("Location:/admin/showadminreq");
    }
}