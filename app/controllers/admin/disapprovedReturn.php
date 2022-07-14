<?php

namespace Controller;
session_start();

class DisapprovedReturn{
    public function post(){
        \Controller\Utils::loggedInAdmin();
        
        $name=$_POST["name"];
        $username=$_POST["username"];
        \Model\Books::disapprovedReturn($name,$username);
        header("Location:/admin/checkin_out");
    }
}