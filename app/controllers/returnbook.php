<?php

namespace Controller;

session_start();

class ReturnBook
{
    public function post()
    {
        \Controller\Utils::LoggedInUser();

        $name = $_POST["name"];
        $uname = $_SESSION["uname"];
        \Model\Books::returnbook($name, $uname);
        header("Location:/client/dashboard");
    }
}
