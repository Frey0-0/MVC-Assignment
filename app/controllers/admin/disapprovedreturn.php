<?php

namespace Controller;
session_start();

class DisapprovedReturn{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $username=$_POST["username"];
        \Model\Books::DisapprovedReturn($name,$username);
        header("Location:/admin/checkin_out");
    }
}