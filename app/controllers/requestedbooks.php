<?php

namespace Controller;
session_start();

class RequestedBooks {
    public function get(){
        \Controller\Utils::LoggedInUser();

        $uname=$_SESSION["uname"];
        echo \View\Loader::make()->render("templates/clientRB.twig",array(
            "requestedbooks" => \Model\Books::requestedbooks($uname),
            "uname" =>$uname,
        ));
    }
}