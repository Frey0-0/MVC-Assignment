<?php

namespace Controller;
session_start();

class RejectedRequests {
    public function get(){
        \Controller\Utils::LoggedInUser();
        
        $uname=$_SESSION["uname"];
        echo \View\Loader::make()->render("templates/clientRR.twig",array(
            "rejectedrequests" => \Model\Books::rejectedrequests($uname),
            "uname" =>$uname,
        ));
    }
}