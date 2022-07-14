<?php

namespace Controller;
session_start();

class RejectedRequests {
    public function get(){
        \Controller\Utils::LoggedInUser();
        
        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/clientRR.twig",array(
            "rejectedrequests" => \Model\Books::RejectedRequests($username),
            "username" =>$username,
        ));
    }
}