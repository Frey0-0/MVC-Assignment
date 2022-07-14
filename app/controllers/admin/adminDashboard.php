<?php

namespace Controller;
session_start();

class AdminDashboard {
    public function get(){
        \Controller\Utils::loggedInAdmin();
        
        echo \View\Loader::make()->render("templates/admin.twig",array(
            "availablebooks" => \Model\Books::availableBooks(),
            "unavailablebooks" => \Model\Books::unavailableBooks(),
            "username" => $_SESSION["username"], 
        ));
    }
}