<?php

namespace Controller;
session_start(); 

class Approved{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $username=$_POST["username"];
        \Model\Books::Approved($name,$username);
        header("Location:/admin/checkin_out");
    }
}