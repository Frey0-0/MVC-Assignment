<?php

namespace Controller;
session_start();


class ApprovedReturn{
    public function post(){
        \Controller\Utils::LoggedInAdmin();
        
        $name=$_POST["name"];
        $uname=$_POST["uname"];
        $result= \Model\Books::approvedreturn($name,$uname);
        if (!isset($result[0])) {
            \Model\Books::approvedreturninsert($name);
        }
        else{
            \Model\Books::approvedreturnupdate($result[0]["quantity"] + 1,$name);
        }
        \Model\Books::approvedreturndelete($name,$uname);
        header("Location:/admin/checkin_out");
    }
}