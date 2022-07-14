<?php

namespace Controller;

session_start();

class RequestBook
{
    public function post()
    {
        \Controller\Utils::LoggedInUser();
        $name = $_POST["name"];
        $uname = $_SESSION["uname"];
        \Model\Books::requestbook($name, $uname);
        header("Location:/client/dashboard");
    }
}
