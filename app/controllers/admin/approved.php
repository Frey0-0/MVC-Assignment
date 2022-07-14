<?php

namespace Controller;
session_start(); 

class Approved{
    public function post(){
        \Controller\Utils::loggedInAdmin();
        
        $name=$_POST["name"];
        $username=$_POST["username"];
        \Model\Books::approved($name,$username);
        header("Location:/admin/checkin_out");
    }
}