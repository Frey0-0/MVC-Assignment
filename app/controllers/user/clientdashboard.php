<?php

namespace Controller;
session_start();

class ClientDashboard {
    public function get(){
        \Controller\Utils::LoggedInUser();

        $username=$_SESSION["username"];
        echo \View\Loader::make()->render("templates/client.twig",array(
            "availablebooks" => \Model\Books::AvailableBooks(),
            "issuedbooks" => \Model\Books::IssuedBooks($username),
            "username" => $_SESSION["username"], 
        ));
    }
}