<?php

namespace Controller;
session_start();

class DisapprovedReturn{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $uname=$_POST["uname"];
        \Model\Books::disapprovedreturn($name,$uname);
        header("Location:/admin/checkin_out");
    }
}