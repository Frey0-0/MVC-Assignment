<?php

namespace Controller;
session_start();


class ApprovedReturn{
    public function post(){
        \Controller\Utils::loggedInAdmin();
        
        $name=$_POST["name"];
        $username=$_POST["username"];
        $result= \Model\Books::approvedReturn($name,$username);
        if (!isset($result[0])) {
            \Model\Books::approvedReturnInsert($name);
        }
        else{
            \Model\Books::approvedReturnUpdate($result[0]["quantity"] + 1,$name);
        }
        \Model\Books::approvedReturnDelete($name,$username);
        header("Location:/admin/checkin_out");
    }
}