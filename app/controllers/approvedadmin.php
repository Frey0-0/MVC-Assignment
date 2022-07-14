<?php

namespace Controller;
session_start();

class ApprovedAdmin{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $uname=$_POST["uname"];
        \Model\Users::approvedadmin($uname);
        header("Location:/admin/showadminreq");
    }
}