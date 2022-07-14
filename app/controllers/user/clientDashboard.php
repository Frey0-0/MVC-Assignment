<?php

namespace Controller;
session_start();

class ClientDashboard {
    public function get(){
        \Controller\Utils::loggedInUser();

        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/client.twig",array(
            "availablebooks" => \Model\Books::availableBooks(),
            "issuedbooks" => \Model\Books::issuedBooks($username),
            "username" => $_SESSION["username"], 
        ));
    }
}