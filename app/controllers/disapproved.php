<?php

namespace Controller;
session_start(); 

class Disapproved{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $uname=$_POST["uname"];
        \Model\Books::disapproved($name,$uname);
        header("Location:/admin/checkin_out");
    }
}