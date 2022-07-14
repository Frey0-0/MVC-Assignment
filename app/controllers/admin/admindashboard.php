<?php

namespace Controller;
session_start();

class AdminDashboard {
    public function get(){
        \Controller\Utils::LoggedInAdmin();
        
        echo \View\Loader::make()->render("templates/admin.twig",array(
            "availablebooks" => \Model\Books::AvailableBooks(),
            "unavailablebooks" => \Model\Books::UnavailableBooks(),
            "username" => $_SESSION["username"], 
        ));
    }
}