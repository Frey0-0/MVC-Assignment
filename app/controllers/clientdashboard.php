<?php

namespace Controller;
session_start();

class ClientDashboard {
    public function get(){
        $uname=$_SESSION["uname"];
        echo \View\Loader::make()->render("templates/client.twig",array(
            "availablebooks" => \Model\Books::availablebooks(),
            "issuedbooks" => \Model\Books::issuedbooks($uname),
            "requestedbooks" => \Model\Books::requestedbooks($uname),
            "rejectedrequests" => \Model\Books::rejectedrequests($uname),
            "uname" => $_SESSION["uname"], 
        ));
    }
}