<?php

namespace Controller;
session_start();

class ClientDashboard {
    public function get(){
        \Controller\Utils::LoggedInUser();

        $uname=$_SESSION["uname"];
        echo \View\Loader::make()->render("templates/client.twig",array(
            "availablebooks" => \Model\Books::availablebooks(),
            "issuedbooks" => \Model\Books::issuedbooks($uname),
            "uname" => $_SESSION["uname"], 
        ));
    }
}