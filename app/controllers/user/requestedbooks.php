<?php

namespace Controller;
session_start();

class RequestedBooks {
    public function get(){
        \Controller\Utils::LoggedInUser();

        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/clientRB.twig",array(
            "requestedbooks" => \Model\Books::RequestedBooks($username),
            "username" =>$username,
        ));
    }
}