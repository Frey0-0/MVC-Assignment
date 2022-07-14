<?php

namespace Controller;
session_start();

class DisapprovedAdmin{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $uname=$_POST["uname"];
        \Model\Users::disapprovedadmin($uname);
        header("Location:/admin/showadminreq");
    }
}