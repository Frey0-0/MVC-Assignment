<?php

namespace Controller;

session_start();

class Disapproved
{
    public function post()
    {
        \Controller\Utils::LoggedInAdmin();

        $name = $_POST["name"];
        $username = $_POST["username"];
        $result = \Model\Books::Disapproved($name, $username);
        if (isset($result[0])) {
            \Model\Books::DisapprovedUpdate($result[0]["quantity"] + 1, $name);
        } else {
            \Model\Books::DisapprovedInsert($name);
        }
        \Model\Books::DisapprovedUpdate2($username, $name);
        header("Location:/admin/checkin_out");
    }
}
