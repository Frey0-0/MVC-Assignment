<?php

namespace Controller;
session_start();

class RejectedRequests {
    public function get(){
        \Controller\Utils::loggedInUser();
        
        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/clientRejectedRequests.twig",array(
            "rejectedrequests" => \Model\Books::rejectedRequests($username),
            "username" =>$username,
        ));
    }
}