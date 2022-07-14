<?php

namespace Controller;
session_start();

class CheckinCheckout {
    public function get(){
        \Controller\Utils::loggedInAdmin();
        
        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/adminCheckinCheckout.twig",array(
            "checkin" => \Model\Books::checkin(),
            "checkout" => \Model\Books::checkout(),
            "username" =>$username,
        ));
    }
}