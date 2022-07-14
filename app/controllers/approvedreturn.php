<?php

namespace Controller;
session_start();


class ApprovedReturn{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $uname=$_POST["uname"];
        \Model\Books::approvedreturn($name,$uname);
        header("Location:/admin/checkin_out");
    }
}