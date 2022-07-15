<?php

namespace Controller;

session_start();

class Disapproved
{
    public function post()
    {
        \Controller\Utils::loggedInAdmin();

        $name = $_POST["name"];
        $username = $_POST["username"];
        $result = \Model\Books::disapproved($name, $username);

        if (isset($result[0])) {
            \Model\Books::disapprovedUpdate($result[0]["quantity"] + 1, $name);
        } 
        else {
            \Model\Books::disapprovedInsert($name);
        }
        \Model\Books::DisapprovedUpdate2($username, $name);
        
        header("Location:/admin/checkin_out");
    }
}
