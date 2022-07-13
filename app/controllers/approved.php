<?php

namespace Controller;
session_start(); 

class Approved{
    public function post(){
        $name=$_POST["name"];
        $uname=$_POST["uname"];
        \Model\Books::approved($name,$uname);
        header("Location:/admin/dashboard");
    }
}