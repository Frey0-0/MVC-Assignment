<?php

namespace Controller;
session_start();

class CheckIn_Out {
    public function get(){
        \Controller\Utils::LoggedInAdmin();
        
        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/adminCC.twig",array(
            "checkin" => \Model\Books::Checkin(),
            "checkout" => \Model\Books::Checkout(),
            "username" =>$username,
        ));
    }
}