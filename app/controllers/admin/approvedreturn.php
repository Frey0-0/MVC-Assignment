<?php

namespace Controller;
session_start();


class ApprovedReturn{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $username=$_POST["username"];
        $result= \Model\Books::ApprovedReturn($name,$username);
        if (!isset($result[0])) {
            \Model\Books::ApprovedReturnInsert($name);
        }
        else{
            \Model\Books::ApprovedReturnUpdate($result[0]["quantity"] + 1,$name);
        }
        \Model\Books::ApprovedReturnDelete($name,$username);
        header("Location:/admin/checkin_out");
    }
}