<?php

namespace Controller;
session_start();

class AdminDashboard {
    public function get(){
        echo \View\Loader::make()->render("templates/admin.twig",array(
            "availablebooks" => \Model\Books::availablebooks(),
            "unavailablebooks" => \Model\Books::unavailablebooks(),
            "checkin" => \Model\Books::checkin(),
            "checkout" => \Model\Books::checkout(),
            "adminreq" => \Model\Users::adminreq(),
            "uname" => $_SESSION["uname"], 
        ));
    }
}