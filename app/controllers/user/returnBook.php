<?php

namespace Controller;

session_start();

class ReturnBook
{
    public function post()
    {
        \Controller\Utils::loggedInUser();

        $name = $_POST["name"];
        $username = $_SESSION["username"];
        \Model\Books::returnBook($name, $username);

        header("Location:/client/dashboard");
    }
}
