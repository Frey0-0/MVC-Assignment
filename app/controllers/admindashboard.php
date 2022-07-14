<?php

namespace Controller;
session_start();

class AdminDashboard {
    public function get(){
        \Controller\Utils::LoggedInAdmin();
        
        echo \View\Loader::make()->render("templates/admin.twig",array(
            "availablebooks" => \Model\Books::availablebooks(),
            "unavailablebooks" => \Model\Books::unavailablebooks(),
            "uname" => $_SESSION["uname"], 
        ));
    }
}