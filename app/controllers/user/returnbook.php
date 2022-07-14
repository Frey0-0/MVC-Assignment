<?php

namespace Controller;

session_start();

class ReturnBook
{
    public function post()
    {
        \Controller\Utils::LoggedInUser();

        $name = $_POST["name"];
        $username = $_SESSION["username"];
        \Model\Books::ReturnBook($name, $username);
        header("Location:/client/dashboard");
    }
}
