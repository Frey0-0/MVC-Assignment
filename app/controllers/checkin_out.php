<?php

namespace Controller;
session_start();

class CheckIn_Out {
    public function get(){
        \Controller\Utils::LoggedInAdmin();
        
        $uname=$_SESSION["uname"];
        echo \View\Loader::make()->render("templates/adminCC.twig",array(
            "checkin" => \Model\Books::checkin(),
            "checkout" => \Model\Books::checkout(),
            "uname" =>$uname,
        ));
    }
}